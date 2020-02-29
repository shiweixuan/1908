<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopCart extends Model
{
    protected $table='shop_cart';
    protected $primaryKey='c_id';
    public $timestamps=false;
    protected $guarded=[];
}
