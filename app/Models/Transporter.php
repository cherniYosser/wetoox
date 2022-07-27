<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transporter extends Model
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

    public function tooxs()
    {
        return $this->belongsToMany('App\Toox');
    }

}
