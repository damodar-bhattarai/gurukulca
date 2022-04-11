<?php

namespace App\Http\Livewire\Backend;

use App\Models\Batch;
use App\Models\Subject;
use App\Models\User;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class CreateUser extends Component
{
    use LivewireAlert;

    public $user;
    public $user_id;
    public $batches,$subjects;

    protected $rules=[
        'user.type'=>'required|in:student,teacher,admin',
        'user.name'=>'required',
        'user.email'=>'nullable|email',
        'user.phone'=>'required|digits:10|unique:users,phone',
        'user.parent_phone'=>'nullable|required_if:user.type,student|digits:10',
        'user.subject_id'=>'nullable|required_if:user.type,teacher',
        'user.code_name'=>'nullable|required_if:user.type,teacher',
        'user.batch_id'=>'nullable|required_if:user.type,student',
    ];

    protected $messages=[
        'user.type.required'=>'Please select user type',
        'user.type.in'=>'Please select user type',
        'user.name.required'=>'Please enter user name',
        'user.email.required'=>'Please enter user email',
        'user.email.email'=>'Please enter valid email',
        'user.phone.unique'=>'Phone already exists',
        'user.phone.required'=>'Please enter user phone',
        'user.phone.digits'=>'Please enter valid phone number',
        'user.parent_phone.required_if'=>'Please enter parent phone',
        'user.parent_phone.digits'=>'Please enter valid phone number',
        'user.subject_id.required_if'=>'Please select subject',
        'user.code_name.required_if'=>'Please enter code name',
        'user.batch_id.required_if'=>'Please select batch',
    ];

    function mount(){
        if($this->user_id){
            $this->user=User::find($this->user_id);
        }else{
            $this->user=new User();
        }
        $this->batches=Batch::select('id','name')->latest()->get();
        $this->subjects=Subject::select('id','name')->latest()->get();
    }

    public function render()
    {
        return view('livewire.backend.create-user');
    }


    public function hydrate()
    {
        $this->resetValidation();
    }


    function save(){
        $this->validate();
        $role=Role::where('name',$this->user->type)->first();
        if(!$role){
            $this->alert('error','Selected User Role Not Found');
            return;
        }
        $this->user->password=bcrypt($this->user->phone);
        $this->user->save();
        $this->user->assignRole($role);

        $this->alert('success',ucfirst($this->user->type).' created successfully',[
            'position'=>'center',
            'toast'=>false
        ]);
        $this->cancel();

    }

    function cancel(){
        $this->mount();
    }
}
