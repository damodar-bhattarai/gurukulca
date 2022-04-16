<?php

namespace App\Http\Livewire\Backend;

use App\Exports\RoutineExport;
use App\Models\Batch;
use App\Models\Routine;
use App\Models\RoutineClass;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ViewRoutine extends Component
{
    use LivewireAlert, WithPagination;

    public $batch;
    public $routine_date;
    public $teacher;

    public $batches;
    public $teachers;


    function mount()
    {
        $this->batches = Batch::select('id', 'name')->latest()->get();
        $this->teachers = User::where('type', 'teacher')->latest()->get();
    }

    function updatedBatch(){
        $this->resetPage();
    }

    function updatedRoutineDate(){
        $this->resetPage();
    }

    function updatedTeacher(){
        $this->resetPage();
    }



    public function render()
    {
        $routines = Routine::with('batch','classes','classes.teacher','classes.subject')->owned();

        if ($this->batch) {
            $routines = $routines->where('batch_id', $this->batch);
        }

        if ($this->routine_date) {
            $routines = $routines->where('routine_date', $this->routine_date);
        }


        if($this->teacher){
            $routines = $routines->whereHas('classes.teacher', function ($q) {
                return $q->where('id', $this->teacher);
            });
        }

        $routines = $routines->latest('routine_date')->get();

        if($this->teacher){
            $routines=$routines->map(function ($routine) {
                $routine->classes = $routine->classes->filter(function ($class) {
                    return $class->teacher_id == $this->teacher;
                });
                return $routine;
            });
        }


        $page = Paginator::resolveCurrentPage() ?: 1;
        $perPage = 10;
        $routines = new LengthAwarePaginator(
            $routines->forPage($page, $perPage), $routines->count(), $perPage, $page, ['path' => Paginator::resolveCurrentPath()]
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

    function export($ext){
        abort_if(!in_array($ext,['xlsx','pdf']),404);

        return Excel::download(new RoutineExport($this->batch,$this->routine_date,$this->teacher),'routine.'.$ext);
    }
}
