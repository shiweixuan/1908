<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artical extends Model
{
    protected $table='artical';
    protected $primaryKey='aid';
    public $timestamps=false;
    protected $guarded=[];
}
