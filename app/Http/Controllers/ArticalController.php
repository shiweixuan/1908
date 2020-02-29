<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Artical;
use Validator;
use Illuminate\Validation\Rule;
class ArticalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $res=Artical::get();
        $acate=request()->acate??'';
        $atitle=request()->atitle??'';
        $where=[];
        if($acate){
            $where[]=["acate","like","%$acate%"];                       
        }
        if($atitle){
            $where[]=["atitle","like","%$atitle%"];                       
        }
        $pageSize=config('app.pageSize');
        $res=Artical::where($where)->orderby('aid','asc')->paginate($pageSize);
        return view('artical.index',['res'=>$res,'acate'=>$acate,'atitle'=>$atitle]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('artical.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 第一种验证 validate
        $request->validate(
            [
            'atitle'=>'required|unique:artical|regex:/^[\x{4e00}-\x{9fa5}A-Za-x0-9]{2,12}$/u',
            'acate'=>'required',
            'is_important'=>'required',
            'is_show'=>'required',
            ],
            [
                'atitle.required'=>'文章标题不能为空',
                'atitle.unique'=>'文章标题已存在',
                'atitle.regex'=>'文章标题不符合规范',
                'acate.required'=>'文章分类不能为空',
                'is_importent.required'=>'文章重要性不能为空',
                'is_show.required'=>'文章是否显示不能为空',
            ]
    );
        $data=$request->except('_token');
        // dd($data);
        //文件上传
        if($request->hasFile('a_img')){
            $data['a_img']=upload('a_img');
        }
        $data['add_time']=time();
        $res=Artical::insert($data);
        if($res){
            return redirect('/artical');
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
        $res=Artical::where('aid',$id)->first();
        return view('artical.edit',['res'=>$res]);
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
        // 第一种验证 validate
        $request->validate(
            [
            'atitle'=>[
                'regex:/^[\x{4e00}-\x{9fa5}A-Za-x0-9]{2,12}$/u',
                Rule::unique('artical')->ignore($id,'aid'),
            ],
            'acate'=>'required',
            'is_important'=>'required',
            'is_show'=>'required',
            ],
            [
                'atitle.unique'=>'文章标题已存在',
                'atitle.regex'=>'文章标题不符合规范',
                'acate.required'=>'文章分类不能为空',
                'is_importent.required'=>'文章重要性不能为空',
                'is_show.required'=>'文章是否显示不能为空',
            ]
        );
        $data=$request->except('_token');
        $res=Artical::where('aid',$id)->update($data);
        if($res!==false){
            return redirect('/artical');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destory($id)
    {
        $res=Artical::destroy($id);
        if($res){
            echo json_encode(['code'=>'00000','msg'=>'ok']);
        }
    }
   
    //ajax唯一性验证
    public function checkOnly(){
        $atitle=request()->atitle;
        $where=[];
        if($atitle){
            $where[]=["atitle","=",$atitle];
        }
        $aid=request()->aid;
        if($aid){
            $where[]=["aid","!=",$aid];
        }
        // \DB::connection()->enableQueryLog();
        $count = Artical::where($where)->count();
        // $logs = \DB::getQueryLog();
        // dd($logs);
        echo json_encode(['code'=>'00000','msg'=>'ok','count'=>$count]);
    }
}
