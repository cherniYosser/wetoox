<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{

    public $timestamps = false;
    protected $guarded = ['id'];



    public function toox(){
        return $this->hasOne('App\Toox');
    }



}
