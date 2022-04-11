<?php

namespace App\Http\Livewire\Backend;

use App\Models\Routine;
use App\Models\RoutineClass;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ViewRoutine extends Component
{
    use LivewireAlert;

    public $batch;
    public $routine_date;

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
            $this->alert('success',$this->routine_date);
            $routines = $routines->where('routine_date', $this->routine_date);
        }
        $routines = $routines->latest('routine_date')->get();

        //get max order
        $max_order = RoutineClass::owned()->where('teacher_id','!=',null)->max('order');

        return view('livewire.backend.view-routine', compact('max_order', 'routines'));
    }


    function delete($id)
    {
        Routine::destroy($id);
        $this->alert('success', 'Routine Deleted Successfully');
    }
}
