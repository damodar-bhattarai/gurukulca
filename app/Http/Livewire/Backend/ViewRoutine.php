<?php

namespace App\Http\Livewire\Backend;

use App\Models\Routine;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ViewRoutine extends Component
{
    use LivewireAlert;

    public function render()
    {
        $routines=Routine::with(['batch','classes'=>function ($q){
            return $q->owned();
        },'classes.teacher','classes.subject'])->owned()->latest('routine_date')->get();
        return view('livewire.backend.view-routine',compact('routines'));
    }


    function delete($id){
        Routine::destroy($id);
        $this->alert('success','Routine Deleted Successfully');
    }
}
