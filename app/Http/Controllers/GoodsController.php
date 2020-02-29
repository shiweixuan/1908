<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Goods;
use App\Brand;
use App\Category;
use Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo 123;
        //设置
        // session(['name'=>'zhangyixing']);
        // request()->session()->save();
        
        //删除
        // session(['name'=>null]);
        // request()->session()->save();
        
        //获取
        // echo session('name');
        
        //设置
        // request()->session()->put('age',18);
        // request()->session()->save();

        // //获取
        // echo request()->session()->get('age');

        // //删除
        // request()->session()->forget('age');

        // dd(request()->session()->get('age'));
        // die;
        
        // Cache::flush();
        
        //接受当前页码
        $page=request()->page??1;

        //获取缓存的值
        // $res = Cache::get('res');
        // $res = cache('res_'.$page);
        $res=Redis::get('res_'.$page);
        // dump($res);
        if(!$res){
            echo '走DB';
            $pageSize=config('app.pageSize');
            $res=Goods::leftjoin('category','goods.cid','=','category.cid')->leftjoin('brand','goods.bid','=','brand.bid')->paginate($pageSize);

            //存入缓存
            // Cache::put('res',$res,60*60*24*30);
            // cache(['res_'.$page=>$res],60*60*24*30);
            $res=serialize($res);
            Redis::setex('res_'.$page,20,$res);
        }
            $res=unserialize($res);
        
        //相册
        foreach($res as $k=>$v){
            $res[$k]['g_imgs']=explode('|',$v['g_imgs']);
        }
        return view('goods.index',['res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // echo session('name');
        $data=Category::all();
        //无限极分类
        $data=getCateInfo($data);
        $brandInfo=Brand::get();
        return view('goods.create',['brandInfo'=>$brandInfo,'data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->except('_token');
        //文件上传
        if($request->hasFile('g_img')){
            $data['g_img']=upload('g_img');
        }
        //多文件上传
        //接收相册信息
        $files=$request->file('g_imgs');
        $g_imgs="";
        foreach($files as $v){
            $g_imgs.=$v->store('imgs').'|';
        }
        //去除右边的|
        $g_imgs=rtrim($g_imgs,'|');
        $data['g_imgs']=$g_imgs;

        $res=Goods::insert($data);
        if($res){
            return redirect('/goods');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Category::all();
        //无限极分类
        $data=getCateInfo($data);
        $brandInfo=Brand::get();
        $res=Goods::where('g_id',$id)->first();
        return view('goods.edit',['res'=>$res,'brandInfo'=>$brandInfo,'data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=$request->except('_token');
        //文件上传
        if($request->hasFile('g_img')){
            $data['g_img']=upload('g_img');
        }
        //多文件上传
        //接收相册信息
        $files=$request->file('g_imgs');
        $g_imgs="";
        foreach($files as $v){
            $g_imgs.=$v->store('imgs').'|';
        }
        //去除右边的|
        $g_imgs=rtrim($g_imgs,'|');
        $data['g_imgs']=$g_imgs;

        $res=Goods::where('g_id',$id)->update($data);
        if($res!==false){
            return redirect('/goods');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=Goods::destroy($id);
        if($res){
            echo json_encode(['code'=>'00000','msg'=>'ok']);
        }
    }
    //ajax唯一性验证
    public function checkOnly(){
        $g_name=request()->g_name;
        $where=[];
        if($g_name){
            $where[]=["g_name","=",$g_name];
        }
        $g_id=request()->g_id;
        if($g_id){
            $where[]=["g_id","!=",$g_id];
        }
        // \DB::connection()->enableQueryLog();
        $count = Goods::where($where)->count();
        // $logs = \DB::getQueryLog();
        // dd($logs);
        echo json_encode(['code'=>'00000','msg'=>'ok','count'=>$count]);
    }
    
    
}
