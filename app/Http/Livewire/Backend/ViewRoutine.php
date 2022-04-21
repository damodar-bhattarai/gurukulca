<?php

namespace App\Http\Livewire\Backend;

use App\Exports\RoutineExport;
use App\Models\Batch;
use App\Models\Routine;
use App\Models\RoutineClass;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Str;

class ViewRoutine extends Component
{
    use LivewireAlert, WithPagination;

    public $batch;
    public $routine_date;
    public $teacher;

    public $batches;
    public $teachers;
    public $selectedRoutines = [];


    function mount()
    {
        $this->batches = Batch::select('id', 'name')->latest()->get();
        $this->teachers = User::where('type', 'teacher')->latest()->get();
        $this->routine_date = Date('Y-m-d');
    }

    function updatedBatch()
    {
        $this->resetPage();
    }

    function updatedRoutineDate()
    {
        $this->resetPage();
    }

    function updatedTeacher()
    {
        $this->resetPage();
    }



    public function render()
    {
        $routines = Routine::with('batch', 'classes', 'classes.teacher', 'classes.subject')->owned();

        if ($this->batch) {
            $routines = $routines->where('batch_id', $this->batch);
        }

        if ($this->routine_date) {
            $routines = $routines->where('routine_date', $this->routine_date);
        }


        if ($this->teacher) {
            $routines = $routines->whereHas('classes.teacher', function ($q) {
                return $q->where('id', $this->teacher);
            });
        }

        $routines = $routines->latest('routine_date')->get();

        if ($this->teacher) {
            $routines = $routines->map(function ($routine) {
                $routine->classes = $routine->classes->filter(function ($class) {
                    return $class->teacher_id == $this->teacher;
                });
                return $routine;
            });
        }


        $page = Paginator::resolveCurrentPage() ?: 1;
        $perPage = 20;
        $routines = new LengthAwarePaginator(
            $routines->forPage($page, $perPage),
            $routines->count(),
            $perPage,
            $page,
            ['path' => Paginator::resolveCurrentPath()]
        );


        //get max order
        $max_order = RoutineClass::owned()->max('order');

        return view('livewire.backend.view-routine', compact('max_order', 'routines'));
    }


    function delete($id)
    {
        Routine::destroy($id);
        $this->alert('success', 'Routine Deleted Successfully');
    }

    function export($ext)
    {
        abort_if(!in_array($ext, ['xlsx', 'pdf']), 404);

        return Excel::download(new RoutineExport($this->batch, $this->routine_date, $this->teacher), 'routine.' . $ext);
    }

    function sendSMS()
    {

        if (!$this->selectedRoutines) {
            $this->alert('error', 'Please select at least one routine');
            return;
        }

        $teachers = User::whereHas('roles', function ($q) {
            $q->where('name', 'teacher');
        })->get();

        $routinesToSend = Routine::whereIn('id', $this->selectedRoutines)->get();


        $sent_teachers = [];
        $failed_teachers = [];

        foreach ($teachers as $teacher) {
            $message = '';
            $batches = [];

            $classes = RoutineClass::with('routine', 'routine.batch')->where('teacher_id', $teacher->id)
                ->whereIn('routine_id', $routinesToSend->pluck('id')->toArray())
                ->get();

            if ($classes->count() == 0) {
                continue;
            }

            //starting message (total classes for teacher today)
            // $message = 'You have ' . $classes->count() . ' ' . Str::plural('class', $classes->count()) . " on ".$routinesToSend->routine_date." \r\n";

            $message = "";

            foreach ($classes as $class) {
                if (!isset($batches[$class->routine->routine_date][$class->routine->batch->name])) {
                    $batches[$class->routine->routine_date][$class->routine->batch->name] = [];
                }
                $batches[$class->routine->routine_date][$class->routine->batch->name][] = $class->order;
            }


            foreach ($batches as $date => $btcs) {
                $message .= "Routine for ". $date . "\r\n";

                foreach ($btcs as $batch => $classes) {
                    $message .= $batch . "\r\n".'Class ' . implode(', ', $classes) . "\r\n";
                }
            }

            Log::info('Triggered SMS to ' . $teacher->name . ' at ' . $teacher->phone);
            Log::info('Message: ' . $message);
            try {
                $response = Http::get('https://smsprima.com/api/api/index', [
                    'username' => 'sajesh',
                    'password' => '123456789',
                    'sender' => 'DigitalSMS',
                    'destination' => $teacher->phone,
                    'type' => 1,
                    'message' => $message
                ]);
                Log::info('SMS Success: ' . $response->body());
                $sent_teachers[]=$teacher->name;
            } catch (\Exception $e) {
                Log::error('SMS Error: ' . $e->getMessage());
                $failed_teachers[]=$teacher->name;
            }
        }

        $message = '';
        if ($sent_teachers) {
            $message .= 'SMS sent to ' . implode(', ', $sent_teachers) . ' successfully.';
        }
        if ($failed_teachers) {
            $message .= 'SMS failed to ' . implode(', ', $failed_teachers) . '.';
        }

        $this->alert('info', $message);

        $this->selectedRoutines = [];
    }
}
