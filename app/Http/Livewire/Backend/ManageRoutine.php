<?php

namespace App\Http\Livewire\Backend;

use App\Models\Batch;
use App\Models\Routine;
use App\Models\RoutineClass;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ManageRoutine extends Component
{
    use LivewireAlert;

    public $routine;
    public $editing;
    public $batches;
    public $classes =  [];
    public $teachers;
    public $routine_id;

    protected $rules = [
        'routine.routine_date' => 'required|date|after:yesterday',
        'routine.batch_id' => 'required|exists:batches,id',
        'classes.*.teacher_id' => 'nullable|exists:users,id',
        'classes.*.order' => 'nullable',
    ];

    function mount()
    {
        if ($this->routine_id) {
            $this->routine = Routine::with('classes')->find($this->routine_id);
            $this->editing = true;

            for($i=0;$i<6;$i++){
                if(isset($this->routine->classes[$i])){
                    $this->classes[$i]['teacher_id'] = $this->routine->classes[$i]->teacher_id;
                }else{
                    $this->classes[$i]['teacher_id'] = null;
                }

            }

        } else {
            $this->routine = new Routine();
            $this->editing = false;
            $this->classes = [[], [], [], [], [], []];
        }
        $this->batches = Batch::select('id', 'name')->latest()->get();
        $this->teachers = User::where('type', 'teacher')->latest()->get();
    }


    public function render()
    {
        if($this->routine->routine_date){
            $routines =  Routine::with('batch','classes','classes.teacher','classes.subject')->where('routine_date', $this->routine->routine_date)->get();
        }else{
            $routines=collect();
        }
        //get max order
        $max_order = RoutineClass::owned()->max('order');

        return view('livewire.backend.manage-routine', compact('max_order','routines'));
    }

    function updatedRoutine()
    {
        if ($this->routine->routine_date && $this->routine->batch_id) {
            $routine = Routine::with('classes')->where('routine_date', $this->routine->routine_date)->where('batch_id', $this->routine->batch_id)->first();
            if ($routine) {
                $this->alert('success', 'updated');
                $this->routine = $routine;
                if ($routine->classes && $routine->classes->count() > 0) {
                    $this->classes = [];

                    for($i=0;$i<6;$i++){
                        if(isset($routine->classes[$i])){
                            $this->classes[$i]['teacher_id'] = $routine->classes[$i]->teacher_id;
                        }else{
                            $this->classes[$i]['teacher_id'] = null;
                        }

                    }
                }
                $this->alert('success', 'Previous Data Loaded');
            }else{
                $this->routine->id=null;
            }
        }


    }

    function resetForm()
    {
        if($this->editing){
            $this->redirect(route('backend.routines.index'));
            return;
        }
        $tempDate=$this->routine->routine_date;
        $this->mount();
        $this->routine->routine_date=$tempDate;
    }

    function save()
    {
        $this->validate();

        //get teachers id as array
        $teachers_id = [];
        foreach ($this->classes as $index=>$class) {
            if(isset($class['teacher_id']) && !empty($class['teacher_id'])) $teachers_id[$index+1] = $class['teacher_id'];
        }
        $routines=Routine::with('classes','batch')->where('id','!=',$this->routine->id)->whereDate('routine_date',$this->routine->routine_date)->get();
        foreach($routines as $routine){
            foreach($routine->classes as $class){
                if(isset($teachers_id[$class->order]) && $teachers_id[$class->order]==$class->teacher_id){
                    if(in_array($class->teacher_id,$teachers_id)){
                        $teacher=User::find($class->teacher_id);
                        $this->alert('error', $teacher->name.' already assigned on batch '.$routine->batch->name.' on Class '.$class->order);
                        return;
                    }
                }

            }
        }



        $this->routine->save();

        $this->routine->classes()->delete();

        foreach ($this->classes as $index => $class) {
            $class['order'] = $index + 1;
           if(empty($class['teacher_id'])) unset($class['teacher_id']);
            $this->routine->classes()->create($class);
        }
        $this->resetForm();
        if ($this->routine_id) {
            $this->flash('success', 'Routine Updated Successfully');
            return redirect()->route('backend.routines.index');
        } else {
            $this->alert('success', 'Routine Saved Successfully');
        }
    }

    function addClass()
    {
        $this->classes[] = [];
    }

    function removeClass($index)
    {
        unset($this->classes[$index]);
    }
}
