<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    //protected $table = "skills"; //caso não encontre podemos apontar
   // use SoftDeletes;
    protected $fillabs = [
        'description'
    ];

    protected $hidden = [
        //'id' ocultar campos 
    ];
}
