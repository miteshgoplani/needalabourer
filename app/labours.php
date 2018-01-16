<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class labours extends Model
{
    protected $table='labours';
    
    //primary key
    public $primaryKey='id';
    
    //Timestamps
    public $timestamps=true;
}
