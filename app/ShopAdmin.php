<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopAdmin extends Model
{
    protected $table='shop_admin';
    protected $primaryKey='a_id';
    public $timestamps=false;
    protected $guarded=[];
}
