<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    use HasFactory;

    protected $guarded=[];

    function classes(){
        return $this->hasMany(RoutineClass::class);
    }

    function batch(){
        return $this->belongsTo(Batch::class);
    }

    function scopeOwned($query){
       if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('teacher')){
           return $query;
       }else{
            return $query->where('batch_id',auth()->user()->batch_id);
       }
    }


    protected static function booted()
    {
        if(!auth()->user()->hasRole('admin')){
            self::addGlobalScope('twoDays', function ($query){
                $query->where('routine_date','>=',Date('Y-m-d'))->where('routine_date','<',Carbon::now()->addDays(1));
            });
        }
    }

}
