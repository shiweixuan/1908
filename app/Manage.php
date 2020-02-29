<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manage extends Model
{
    protected $table='manage';
    protected $primaryKey='mid';
    public $timestamps=false;
    protected $guarded=[];
}
