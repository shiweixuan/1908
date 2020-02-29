<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='category';
    protected $primaryKey='cid';
    public $timestamps=false;
    protected $guarded=[];
}
