<?php

namespace App;


use Illuminate\Database\Eloquent\Model;


class Picker extends Model
{


    public $timestamps = false;
    
    protected $guarded = ['id'];
    
    
    
    public function toox(){
        return $this->hasOne('App\Toox');
    }

    
}
