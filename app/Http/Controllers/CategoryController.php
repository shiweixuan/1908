<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Category::all();
        //无限极分类
        $data=$this->getCateInfo($data);
        return view('category.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=Category::all();
        //无限极分类
        $data=$this->getCateInfo($data);
        return view('category.create',['data'=>$data]);
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
        $res=Category::insert($data);
        if($res){
            return redirect('/category');
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
        $data=$this->getCateInfo($data);
        $res=Category::where('cid',$id)->first();
        return view('category.edit',['res'=>$res,'data'=>$data]);
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
        $res=Category::where('cid',$id)->update($data);
        if($res){
            return redirect('/category');
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
        $res=Category::destroy($id);
        if($res){
            echo json_encode(['code'=>'00000','msg'=>'ok']);
        }
    }
     /**
     * 无限极分类
     */
    //$level等级，在视图页面根据等级决定输出多少个空格
    function getCateInfo($data,$pid=0,$level=1){
        //将数据存到一个静态数组中，在函数执行完后，变量值仍保存
        static $info=[];
        if(!$data){
            return;
        }
        foreach($data as $k=>$v){
            //如果pid等于0取出所有的顶级分类，我们不只是要取出顶级分类，还要取出顶级分类中的子类，需要将等于后面的值写活
            if($v->pid==$pid){
                // print_r($v);
                $v->level=$level;
                $info[]=$v;
                //刚刚已经查询到所有顶级的分类，调用自己，再查一遍，传数据，再传刚查到数据的分类id
                $this->getCateInfo($data,$v->cid,$level+1);
            }
        }
        //将数据返回
        return $info;
    }
    //ajax唯一性验证
    public function checkOnly(){
        $cname=request()->cname;
        $where=[];
        if($cname){
            $where[]=["cname","=",$cname];
        }
        $cid=request()->cid;
        if($cid){
            $where[]=["cid","!=",$cid];
        }
        // \DB::connection()->enableQueryLog();
        $count = Category::where($where)->count();
        // $logs = \DB::getQueryLog();
        // dd($logs);
        echo json_encode(['code'=>'00000','msg'=>'ok','count'=>$count]);
    }
}
