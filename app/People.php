<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    protected $table='woker';
    protected $primaryKey='wid';
    public $timestamps=false;
}
