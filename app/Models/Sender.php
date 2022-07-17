<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sender extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tooxes()
    {
        return $this->hasMany('App\Toox');
    }
    
}
