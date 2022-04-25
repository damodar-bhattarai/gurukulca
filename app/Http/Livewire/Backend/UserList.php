<?php

namespace App\Http\Livewire\Backend;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination, LivewireAlert;

    public $type;
    public $sort_by='id';
    public $sort_order='desc';
    public $search;

    public function render()
    {
        $users=User::with('batch','subject');
        $users=$users->where('type',$this->type);



        if($this->search){
            $users=$users->where(function($q){
                $q->orWhere('name','like','%'.$this->search.'%')
                ->orWhere('email','like','%'.$this->search.'%')
                ->orWhere('batch_id','like','%'.$this->search.'%')
                ->orWhere('phone','like','%'.$this->search.'%')
                ->orWhere('code_name','like','%'.$this->search.'%')
                ->orWhereHas('batch',function($q){
                    $q->where('name','like','%'.$this->search.'%');
                })
                ->orWhereHas('subject',function($q){
                    $q->where('name','like','%'.$this->search.'%');
                });
            });
        }

        if($this->sort_by=='batch'){
            $users=$users->join('batches', 'batches.id', '=', 'users.batch_id')
                        ->orderBy('batches.name',$this->sort_order);
        }
        elseif($this->sort_by=='subject'){
            $users=$users->join('subjects', 'subjects.id', '=', 'users.subject_id')
            ->orderBy('subjects.name',$this->sort_order);
        }
        else{
            $users=$users->orderBy($this->sort_by,$this->sort_order);
        }


        $users= $users->paginate(10);


        return view('livewire.backend.user-list',compact('users'));
    }

    function sort($col){
        $this->sort_by=$col;
        if($this->sort_order=='desc'){
            $this->sort_order='asc';
        }else{
            $this->sort_order='desc';
        }
    }

    function deleteUser($id){
        DB::beginTransaction();
        try{
            User::destroy($id);
            $this->alert('success','User deleted successfully');
            DB::commit();
        }
        catch(Exception $e){
            DB::rollback();
            $this->alert('info',$e->getMessage());
        }
    }
}
