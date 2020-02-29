<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShopAdmin;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res=ShopAdmin::get();
        return view('admin.index',['res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
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
        $data['a_pwd']=encrypt($data['a_pwd']);
        $res=ShopAdmin::create($data);
        if($res){
            return redirect('/admin');
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
        $res=ShopAdmin::where('a_id',$id)->first();
        return view('admin.edit',['res'=>$res]);
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
        $res=ShopAdmin::where('a_id',$id)->update($data);
        if($res!==false){
            return redirect('/admin');
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
        $res=ShopAdmin::destroy($id);
        if($res){
            echo json_encode(['code'=>'00000','msg'=>'ok']);
        }
    }
    //ajax唯一性验证
    public function checkOnly(){
        $a_name=request()->a_name;
        $where=[];
        if($a_name){
            $where[]=["a_name","=",$a_name];
        }
        $a_id=request()->a_id;
        if($a_id){
            $where[]=["a_id","!=",$a_id];
        }
        // \DB::connection()->enableQueryLog();
        $count = ShopAdmin::where($where)->count();
        // $logs = \DB::getQueryLog();
        // dd($logs);
        echo json_encode(['code'=>'00000','msg'=>'ok','count'=>$count]);
    }
}
