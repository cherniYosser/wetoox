<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Toox extends Model
{


  
    
    public $timestamps = false;
    protected $guarded = ['id'];
    protected $appends = ['img'];
    
    

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
