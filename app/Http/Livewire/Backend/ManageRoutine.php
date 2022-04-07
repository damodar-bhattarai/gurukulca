<?php

namespace App\Http\Livewire\Backend;

use App\Models\Batch;
use App\Models\Routine;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ManageRoutine extends Component
{
    use LivewireAlert;

    public $routine;
    public $editing;
    public $batches;
    public $classes = [];
    public $teachers;
    public $routine_id;

    protected $rules = [
        'routine.routine_date' => 'required|date|after:yesterday',
        'routine.batch_id' => 'required|exists:batches,id',
        'classes.*.teacher_id' => 'required|exists:users,id',
    ];

    function mount()
    {
        if ($this->routine_id) {
            $this->routine = Routine::with('classes')->find($this->routine_id);
            $this->editing = true;
            foreach ($this->routine->classes as $class) {
                $this->classes[] = [
                    'teacher_id' => $class->teacher_id,
                ];
            }
        } else {
            $this->routine = new Routine();
            $this->editing = false;
            $this->classes = [[], [], [], []];
        }
        $this->batches = Batch::select('id', 'name')->latest()->get();
        $this->teachers = User::where('type', 'teacher')->latest()->get();
    }


    public function render()
    {
        return view('livewire.backend.manage-routine');
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
                    foreach ($routine->classes as $class) {
                        $this->classes[] = [
                            'teacher_id' => $class->teacher_id,
                        ];
                    }
                }
                $this->alert('success', 'Classes Loaded Successfully');
            }
        }
    }

    function resetForm()
    {
        $this->mount();
    }

    function save()
    {
        $this->validate();
        $this->routine->save();

        $this->routine->classes()->delete();
        foreach ($this->classes as $index=>$class) {
            $class['order'] = $index+1;
            $this->routine->classes()->create($class);
        }
        $this->resetForm();
        if($this->routine_id){
            $this->flash('success', 'Routine Updated Successfully');
            return redirect()->route('backend.routines.index');
        }else{
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
