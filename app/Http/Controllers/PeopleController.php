<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use DB;
use App\People;
use App\Http\Requests\StorePeoplePost;
use Validator;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表页展示
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wname=request()->wname??'';
        $where=[];
        if($wname){
            $where[]=["wname","like","%$wname%"];
        }
        // $data=Db::table('woker')->select('*')->get();
        // $data=People::all();
        // $data=People::get();
        // 分页 搜索
        $pageSize=config('app.pageSize');
        $data=People::where($where)->orderby('wid','asc')->paginate($pageSize);
        // dd($data);
        return view('people.index',['data'=>$data,'wname'=>$wname]);
    }

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('people.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    // 第二种验证
    // public function store(StorePeoplePost $request)
    {
        //第一种验证 validate
    //     $request->validate(
    //         [
    //         'wname'=>'required|unique:woker|max:12|min:2',
    //         'wage'=>'required|integer|between:1,150',
    //         ],
    //         [
    //             'wname.required'=>'名字不能为空',
    //             'wname.unique'=>'名字已存在',
    //             'wname.max'=>'名字长度不能超过12位',
    //             'wname.min'=>'名字不能不能少于2位',
    //             'wage.required'=>'年龄不能为空',
    //             'wage.integer'=>'年龄必须为数字',
    //             'wage.between'=>'年龄数据不合法',
    //         ]
    // );

        $data=$request->except('_token');
        // dd($data);
        
        //第三种验证
        $validator=Validator::make($data,
            [
                'wname'=>'required|unique:woker|max:12|min:2',
                'wage'=>'required|integer|between:1,150',
            ],
            [
                'wname.required'=>'名字不能为空',
                'wname.unique'=>'名字已存在',
                'wname.max'=>'名字长度不能超过12位',
                'wname.min'=>'名字不能不能少于2位',
                'wage.required'=>'年龄不能为空',
                'wage.integer'=>'年龄必须为数字',
                'wage.between'=>'年龄数据不合法',
            ]
        );
        if($validator->fails()){
            return redirect('people/create')
                    ->withErrors($validator)
                    ->withInput();
        }

        //文件上传
        if($request->hasFile('w_img')){
            $data['w_img']=$this->upload('w_img');
        }

        $data['add_time']=time();
        //DB
        // $res=Db::table('woker')->insert($data);
        //ORM create
        //$res=People::create($data);
        $res=People::insert($data);
        
        if($res){
            return redirect('/people');
        }
        
    }

    /**
     * Display the specified resource.
     *预览详页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *编辑页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //DB
        // $res=Db::table('woker')->where('wid',$id)->first();
        // ORM
        $res=People::where('wid',$id)->first();
        return view('people.edit',['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *执行编辑
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $res=$request->except('_token');

         //文件上传
        if($request->hasFile('w_img')){
            $res['w_img']=$this->upload('w_img');
        }
        //DB
        // $data=Db::table('woker')->where('wid',$id)->update($res);
        // ORM
        $data=People::where('wid',$id)->update($res);
        // dd($data);
        if($data!==false){
            return redirect('/people');
        }
    }

    /**
     * Remove the specified resource from storage.
     *删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //DB
        // $data=Db::table('woker')->where('wid',$id)->delete();
        //ORM
        $data=People::destroy($id);
        if($data){
            return redirect('/people');
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
