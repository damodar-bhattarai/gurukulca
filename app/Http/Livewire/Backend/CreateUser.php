<?php

namespace App\Http\Livewire\Backend;

use App\Models\Batch;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class CreateUser extends Component
{
    use LivewireAlert;

    public $user;
    public $user_id;
    public $change_password=false;
    public $new_password;
    public $batches, $subjets;

    function rules()
    {
        return [
            'user.type' => 'required|in:student,teacher,admin',
            'user.name' => 'required',
            'user.email' => 'nullable|email',
            'new_password'=>[
                'nullable','required_if:change_password,true',
            Password::min(8)
            ->mixedCase()
            ->letters()
            ->numbers()
            ->symbols()
            ->uncompromised()],
            'user.phone' => 'required|digits:10|unique:users,phone,' . $this->user_id,
            'user.parent_phone' => 'nullable|required_if:user.type,student|digits:10',
            'user.subject_id' => 'nullable|required_if:user.type,teacher',
            'user.code_name' => 'nullable|required_if:user.type,teacher',
            'user.batch_id' => 'nullable|required_if:user.type,student',
        ];
    }

    protected $messages = [
        'user.type.required' => 'Please select user type',
        'user.type.in' => 'Please select user type',
        'user.name.required' => 'Please enter user name',
        'user.email.required' => 'Please enter user email',
        'user.email.email' => 'Please enter valid email',
        'user.phone.unique' => 'Phone already exists',
        'user.phone.required' => 'Please enter user phone',
        'user.phone.digits' => 'Please enter valid phone number',
        'user.parent_phone.required_if' => 'Please enter parent phone',
        'user.parent_phone.digits' => 'Please enter valid phone number',
        'user.subject_id.required_if' => 'Please select subject',
        'user.code_name.required_if' => 'Please enter code name',
        'user.batch_id.required_if' => 'Please select batch',
        'new_password.required' => 'Please enter password',
        'new_password.min' => 'Password must be at least 8 characters',
    ];

    function mount()
    {
        if ($this->user_id) {
            $this->user = User::find($this->user_id);
        } else {
            $this->user = new User();
        }
        $this->batches = Batch::select('id', 'name')->latest()->get();
        $this->subjects = Subject::select('id', 'name')->latest()->get();
    }

    public function render()
    {
        return view('livewire.backend.create-user');
    }


    public function hydrate()
    {
        $this->resetValidation();
    }


    function save()
    {
        $this->validate();
        $role = Role::where('name', $this->user->type)->first();
        if (!$role) {
            $this->alert('error', 'Selected User Role Not Found');
            return;
        }
        if($this->change_password){
            $this->user->password=bcrypt($this->new_password);
        }else if(!$this->user_id){
            $this->user->password = bcrypt($this->user->phone);
        }
        $this->user->save();
        $this->user->assignRole($role);

        $this->alert('success', ucfirst($this->user->type) . ' saved successfully', [
            'position' => 'center',
            'toast' => false
        ]);

        if($this->user_id){
            if($this->user->type == 'student'){
                $this->redirect(route('backend.user.students'));
            }elseif($this->user->type == 'teacher'){
                $this->redirect(route('backend.user.teachers'));
            }elseif($this->user->type == 'admin'){
                $this->redirect(route('backend.user.admins'));
            }
        }
        $this->cancel();
    }

    function cancel()
    {
        $this->mount();
    }
}
