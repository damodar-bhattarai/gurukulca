<?php

namespace App\Http\Livewire\Backend;

use App\Exports\ReportExport;
use App\Models\Batch;
use App\Models\Routine;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class RoutineReport extends Component
{
    public $teachers;
    public $batches;
    public $from_date, $to_date, $batch, $teacher;
    public $showReport = false;
    public $teacherBatchRoutine = [];
    public $batch_class_count = [];
    public $selectedBatches = [];


    function mount()
    {
        $this->to_date = $this->from_date = Carbon::now()->subDay(3)->format('Y-m-d');
        // $this->from_date= Carbon::now()->subDays(3)->format('Y-m-d');

        $this->teachers = User::select('id', 'name', 'code_name')->where('type', 'teacher')->latest()->get();
        $this->batches = Batch::select('id', 'name')->latest()->get();
    }



    public function render()
    {

        return view('livewire.backend.routine-report');
    }


    function download()
    {
        return Excel::download(new ReportExport($this->teacherBatchRoutine, $this->from_date, $this->to_date, $this->selectedBatches, $this->batch_class_count), 'reports.xlsx');
    }


    function preview()
    {
        $this->reportCalculation();
        $this->showReport = true;
    }

    function reportCalculation()
    {
        $this->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'batch' => 'nullable|exists:batches,id',
            'teacher' => 'nullable|exists:users,id',
        ]);

        $from_date = Carbon::parse($this->from_date);
        $to_date = Carbon::parse($this->to_date);

        $this->selectedBatches = Batch::select('id', 'name')->when($this->batch, function ($query) {
            return $query->where('id', $this->batch);
        })->get();


        $teacherBatchRoutine = [];

        $teachers = User::query();
        if ($this->teacher) {
            $teachers = $teachers->where('id', $this->teacher);
        }
        $teachers = $teachers->where('type', 'teacher')->get();

        foreach ($teachers as $teacher) {
            $routines = Routine::with('batch', 'classes', 'classes.teacher')->whereBetween('routine_date', [$from_date, $to_date])
                ->when($this->batch, function ($query) {
                    return $query->where('batch_id', $this->batch);
                })
                ->whereHas('classes.teacher', function ($q) use ($teacher) {
                    return $q->where('id', $teacher->id);
                })
                ->get();

            $batch_group = $routines->groupBy('batch.name');

            foreach ($batch_group as $batch_name => $routines) {

                // $batchClasses = 0;

                // if (in_array($batch_name, $this->selectedBatches->pluck('name')->toArray())) {

                //     $routines->each(function ($routine) use (&$batchClasses, $teacher) {
                //         $batchClasses += $routine->classes->filter(function ($class) use ($teacher) {
                //             if($this->teacher){
                //                 return $class->teacher->id == $teacher->id;
                //             }
                //             return (!empty($class->teacher_id));
                //         })->count();
                //     });

                //     $this->batch_class_count[$batch_name] = $batchClasses;
                // }

                $totalClasses = 0;

                $routines->each(function ($routine) use (&$totalClasses, $teacher) {
                    $totalClasses += $routine->classes->filter(function ($class) use ($teacher) {
                        return $class->teacher_id == $teacher->id;
                    })->count();
                });

                $teacherBatchRoutine[$teacher->name][$batch_name] = $totalClasses;
            }
        }


        $this->teacherBatchRoutine = $teacherBatchRoutine;
    }
}
