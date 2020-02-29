<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ShopCart;

class CartController extends Controller
{
	//加入购物车
    public function create(Request $request){
    	$buy_number=$request->buy_number;
    	$g_id=$request->g_id;
    	// echo $buy_number;
    	// dd($g_id);
    	// 判断用户是否登录
    	$userInfo=session('userInfo');
    	if(!$userInfo){

    	}else{
    		//把数据存入数据库
    		$uid=session('userInfo.uid');
    		$data=['buy_number'=>$buy_number,'g_id'=>$g_id,'add_time'=>time(),'uid'=>$uid];
    		$res=ShopCart::create($data);
    		if($res){
    			echo 'ok';
    		}else{
    			echo 'no';
    		}
    	}
    }
    //购物车列表展示
    public function car(){
    	//判断用户是否登录
    	$userInfo=session('userInfo');
    	if(!$userInfo){

    	}else{
    		$info=ShopCart::select('goods.g_id','g_img','g_name','g_price','g_num','buy_number','add_time')
    		->leftjoin('goods','goods.g_id','=','shop_cart.g_id')
    		->orderby('add_time','desc')
    		->get();
    	}
    	// dd($info);
    	return view('index.car',['info'=>$info]);
    }
}
