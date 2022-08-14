<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Toox extends Model
{

    public $timestamps = false;
    protected $guarded = ['id'];




    public function picker()
    {
        return $this->belongsTo('App\Picker');
    }

    public function receiver()
    {
        return $this->belongsTo('App\Receiver');
    }



    public function transporter()
    {
        return $this->belongsTo('App\Transporter');
    }

    public function transporters()
    {
        return $this->belongsToMany('App\Transporter');
    }

    public function sender()
    {
        return $this->belongsTo('App\Sender');
    }



}
