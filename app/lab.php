<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lab extends Model
{
    //Table Name
    protected $table='labs';
    
    //primary key
    public $primaryKey='id';
    
    //Timestamps
    public $timestamps=true;

    public function user(){
    return $this->belongsTo('App\User');
    }
}
