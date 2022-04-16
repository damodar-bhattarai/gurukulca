<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $guarded=[];

    function teachers(){
        return $this->hasMany(User::class)->where('type','teacher');
    }
}
