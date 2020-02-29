<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redis;

use App\Goods;
use App\Category;
class IndexController extends Controller
{
	public function setCookie(){
		//第一种
		// return response('测试产生cookie')->cookie('name','huanhuan',2);

		//第二种 cookie全局辅助函数
		// $cookie=cookie('name','yixing',2);
		// return response('测试产生cookie2')->cookie($cookie);
		
		//第三种 队列形式设置cookie
		// Cookie::queue(Cookie::make('age', '18', 2));

		//第四种
		// Cookie::queue('aa','11',2);
	}
	//首页
    public function index(){
    	//获取cookie第一种
    	// echo request()->cookie('name');
    	// 获取cookie第二种
    	// $value = Cookie::get('aa');
    	// echo $value;
    	
    	$where=[
    		['pid','=',0],
    	];
    	$data=Category::where($where)->get();
    	// dd($data);
    	$res=Goods::all();
    	// dd($res);
    	return view('index.index',['res'=>$res,'data'=>$data]);
    }
  
    //全部商品
    public function prolist(){
    	// $res=cache('res');
    	// dump($res);
    	// if(!$res){
    		$res=Goods::all();
    		// cache(['res'=>$res],60*60*24*30);
    	// }
    	
    	return view('index.prolist',['res'=>$res]);
    }
    //详情页
    public function proinfo($id){
    	// $goodsInfo=cache('goodsInfo');
    	// dump($goodsInfo);
    	// if(!$goodsInfo){
    		
    		$num=Redis::setnx('num'.$id,1);
    		if(!$num){
    			$num=Redis::incr('num'.$id);
    		}
    		$goodsInfo=Goods::find($id);
    		// cache(['goodsInfo'=>$goodsInfo],60*60*24*30);
    	// }
    	
    	// dd($goodsInfo);
    		//相册
    		$goodsInfo['g_imgs']=explode('|',$goodsInfo['g_imgs']);
 
    	return view('index.proinfo',['goodsInfo'=>$goodsInfo,'num'=>$num]);
    }
    //分类
    public function cate($id){
    	$cateInfo=Category::get();
    	$cid=getCateId($cateInfo,$id);
    	// dd($cid);
    	$goodsInfo=Goods::whereIn('cid',$cid)->get();
    	return view('index.cate',['goodsInfo'=>$goodsInfo]);
    }
   
}
