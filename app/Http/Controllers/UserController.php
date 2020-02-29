<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
    	// echo '欢欢 你好';
        showMsg(1,'Hello World!'); 
    }

    public function add(){
    	return view('user.add');
    }

    public function adddo(Request $request){
    	$data=$request->all();
    	dd($data);
    }

     public function a(){
    	return view('user.a');
    }
}
