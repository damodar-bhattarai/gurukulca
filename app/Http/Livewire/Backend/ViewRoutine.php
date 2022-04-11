<?php

namespace App\Http\Livewire\Backend;

use App\Models\Batch;
use App\Models\Routine;
use App\Models\RoutineClass;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

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
        $routines = Routine::with(['batch' => function ($q) {
            if ($this->batch) {
                return  $q->where('id', $this->batch);
            } else return $q;
        }, 'classes' => function ($q) {
            return $q->owned();
        }, 'classes.teacher', 'classes.subject'])->owned();



        if ($this->routine_date) {
            $routines = $routines->where('routine_date', $this->routine_date);
        }
        if($this->teacher){
            $routines = $routines->whereHas('classes', function ($q) {
                return $q->where('teacher_id', $this->teacher);
            });
        }

        $routines = $routines->latest('routine_date')->paginate(5);

        if($this->teacher){
            $routines=$routines->map(function ($routine) {
                $routine->classes = $routine->classes->filter(function ($class) {
                    return $class->teacher_id == $this->teacher;
                });
                return $routine;
            });
        }

        //get max order
        $max_order = RoutineClass::owned()->max('order');

        return view('livewire.backend.view-routine', compact('max_order', 'routines'));
    }


    function delete($id)
    {
        Routine::destroy($id);
        $this->alert('success', 'Routine Deleted Successfully');
    }
}
