<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use Illuminate\Support\Facades\Cache;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表展示
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Cache::flush();


        $bname=request()->bname??'';
        $where=[];
        if($bname){
            $where[]=["bname","like","%$bname%"];
        }
        //接收当前页码
        $page=request()->page??1;
        // dump($page);
        //获取缓存的值
        $data=cache('data_'.$page.'_'.$bname);
        // dump($data);
        if(!$data){
            $pageSize=config('app.pageSize');
            $data=Brand::where($where)->paginate($pageSize);

            cache([('data_'.$page.'_'.$bname)=>$data],60*5);
        }
        
        //是ajax请求 既要实现呢ajax分页
        if(request()->ajax()){
            return view('brand.ajaxPage',['data'=>$data,'bname'=>$bname]);
        }
        return view('brand.index',['data'=>$data,'bname'=>$bname]);
    }

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->except('_token');
        //文件上传
        if($request->hasFile('bimg')){
            $data['bimg']=$this->upload('bimg');
        }
        $res=Brand::insert($data);
        if($res){
            return redirect('/brand');
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
        $res=Brand::where('bid',$id)->first();
        return view('brand.edit',['res'=>$res]);
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
        if($request->hasFile('bimg')){
            $data['bimg']=$this->upload('bimg');
        }
        $res=Brand::where('bid',$id)->update($data);
        if($res!==false){
            return redirect('/brand');
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
        $res=Brand::destroy($id);
        if($res){
            return redirect('/brand');
        }
    }
     public function upload($filename){
        //判断上传过程中有无错误
        if(request()->file($filename)->isValid()){
            //接收值
            $photo=request()->file($filename);
            //上传
            $store_result=$photo->store('uploads');
            return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');
    }
}
