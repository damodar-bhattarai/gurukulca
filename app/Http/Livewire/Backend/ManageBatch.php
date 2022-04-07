<?php

namespace App\Http\Livewire\Backend;

use App\Models\Batch;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class ManageBatch extends Component
{
    use LivewireAlert;

    public $editing;
    public $batch;

    protected $rules=[
        'batch.name'=>'required|unique:batches,name',
    ];

    protected $messages=[
        'batch.name.required'=>'Please enter batch name'
    ];

    function mount(){
        $this->batch=new Batch();
        $this->editing=false;
    }

    public function render()
    {
        $batches=Batch::withCount('students')->latest()->get();
        return view('livewire.backend.manage-batch',compact('batches'));
    }

    function save(){
        $this->validate();
        $this->batch->save();
        $this->mount();
        $this->alert('success','Batch Saved Successfully');
    }

    function edit($id){
        $batch=Batch::find($id);
        if($batch){
            $this->batch=$batch;
            $this->editing=true;
        }else{
            $this->alert('error','Batch Not Found',[
                'position'=>'center',
                'toast'=>false
            ]);
        }
    }

    function delete($id){
        Batch::destroy($id);
        $this->mount();
        $this->alert('success','Batch Deleted Successfully');
    }

    function cancel(){
        $this->mount();
    }
}
