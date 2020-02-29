<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Manage;
class ManageController extends Controller
{
    public function create()
    {
        return view('manage.create');
    }

    public function store(Request $request)
    {
        $data=$request->except('_token');
        $where=[
            ['m_number','=',$data['m_number']],
            ['m_pwd','=',md5(md5($data['m_pwd']))]
        ];
        $res=Manage::where($where)->first();
        // dd($res);
        if($res){
            //把用户存入session中
            session(['adminuser'=>$res]);
            //用save保存
            $request->session()->save();
            return redirect('/manage/index');
        }
        return redirect('/manage/create')->with('msg','没有此用户');
    }
    public function index(){
        return view('manage.index');
    }
    public function show(){
        $res=Manage::get();
        return view('manage.show',['res'=>$res]);
    }
    public function delete($id){
        $res=Manage::destroy($id);
        if($res){
            return redirect('/manage/show');
        }
    }
    public function add(){
        return view('manage.add');
    }
    public function add_do(Request $request){
        $data=$request->except('_token');
        $data['m_pwd']=md5(md5($data['m_pwd']));
        $res=Manage::insert($data);
        if($res){
            return redirect('/manage/show');
        }
    }
}
