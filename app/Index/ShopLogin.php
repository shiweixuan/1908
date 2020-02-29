<?php

namespace App\Index;

use Illuminate\Database\Eloquent\Model;

class ShopLogin extends Model
{
    protected $table='shop_user';
    protected $primaryKey='uid';
    public $timestamps=false;
    protected $guarded=[]; 
}
