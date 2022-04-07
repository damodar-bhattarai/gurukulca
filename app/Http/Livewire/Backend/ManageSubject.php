<?php

namespace App\Http\Livewire\Backend;

use App\Models\Subject;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ManageSubject extends Component
{
    use LivewireAlert;

    public $editing;
    public $subject;

    protected $rules=[
        'subject.name'=>'required|unique:subjects,name',
    ];

    protected $messages=[
        'subject.name.required'=>'Please enter subject name'
    ];

    function mount(){
        $this->subject=new Subject();
        $this->editing=false;
    }

    public function render()
    {
        $subjects=Subject::withCount('students')->latest()->get();
        return view('livewire.backend.manage-subject',compact('subjects'));
    }

    function save(){
        $this->validate();
        $this->subject->save();
        $this->mount();
        $this->alert('success','Subject Saved Successfully');
    }

    function edit($id){
        $subject=Subject::find($id);
        if($subject){
            $this->subject=$subject;
            $this->editing=true;
        }else{
            $this->alert('error','Subject Not Found',[
                'position'=>'center',
                'toast'=>false
            ]);
        }
    }

    function delete($id){
        Subject::destroy($id);
        $this->mount();
        $this->alert('success','Subject Deleted Successfully');
    }

    function cancel(){
        $this->mount();
    }
}
