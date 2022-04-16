<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoutineClass extends Model
{
    use HasFactory;
    protected $guarded=[];


    function routine(){
        return $this->belongsTo(Routine::class);
    }

    function teacher(){
        return $this->belongsTo(User::class,'teacher_id')->withDefault('name','-');
    }

    function subject(){
        return $this->hasOneThrough(Subject::class,User::class,'id','id','teacher_id','subject_id')->withDefault('name','-');
    }

    function scopeOwned($query){
       if(auth()->user()->hasRole('teacher')){
           return $query->where('teacher_id',auth()->user()->id);
         }else{
              return $query;
            }
    }

}
