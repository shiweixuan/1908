<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	// echo '111';
	$name='1908 欢迎你';
    return view('welcome',['name'=>$name]);
});


Route::get('/user','UserController@index');

Route::get('/brand','UserController@a');

Route::get('/category','UserController@add');

//post路由 路由别名
Route::post('/adddo','UserController@adddo')->name('do');



Route::get('/show', function () {
	echo '这是商品详情';
});
//必选参数
Route::get('/show/{id}/{name}', function ($id,$name) {
	echo '商品ID是：'.$id."<br>";
	echo '关键字是：'.$name;
});
//可选参数
Route::get('/show/{id?}', function ($goods_id=null) {
	echo '商品ID是：';
	echo $goods_id;
});
//正则约束
	Route::get('/goods/{id}', function ($goods_id) {
		echo '商品ID是：';
		echo $goods_id;
	});

	Route::get('/show/{id}', function ($age_id) {
		echo '年龄是：';
		echo $age_id;
	});

	Route::get('/goods/{id}/{name}', function ($goods_id,$name) {
		echo '商品ID是：';
		echo $goods_id;
		echo '商品名称是：';
		echo $name;
	})->where(['name'=>'\w+']);
//外来务工人员添加
Route::prefix('people')->middleware('checklogin')->group(function(){
	Route::get('create','PeopleController@create');
	Route::post('store','PeopleController@store');
	Route::get('/','PeopleController@index');
	Route::get('edit/{id}','PeopleController@edit');
	Route::post('update/{id}','PeopleController@update');
	Route::get('destroy/{id}','PeopleController@destroy');
});
// Route::view('/login','login');
// Route::post('/logindo','LoginController@logindo');
//学生表添加
Route::get('/student/create','StudentController@create');
Route::post('/student/store','StudentController@store');
Route::get('/student','StudentController@index');
Route::get('/student/edit/{id}','StudentController@edit');
Route::post('/student/update/{id}','StudentController@update');
Route::get('/student/destroy/{id}','StudentController@destroy');
//品牌表添加
Route::get('/brand/create','BrandController@create');
Route::post('/brand/store','BrandController@store');
Route::get('/brand','BrandController@index');
Route::get('/brand/edit/{id}','BrandController@edit');
Route::post('/brand/update/{id}','BrandController@update');
Route::get('/brand/destroy/{id}','BrandController@destroy');
//文章表添加
Route::prefix('artical')->middleware('articallogin')->group(function(){
	Route::get('create','ArticalController@create');
	Route::post('store','ArticalController@store');
	//唯一性验证
	Route::post('/checkOnly','ArticalController@checkOnly');
	Route::get('/','ArticalController@index');
	Route::get('edit/{id}','ArticalController@edit');
	Route::post('update/{id}','ArticalController@update');
	Route::get('destory/{id}','ArticalController@destory');
});
// Route::view('/login','login');
// Route::post('/logindo','LoginController@logindo');
//分类表添加
Route::get('/category/create','CategoryController@create');
Route::post('/category/store','CategoryController@store');
//唯一性验证
Route::post('/category/checkOnly','CategoryController@checkOnly');
Route::get('/category','CategoryController@index');
Route::get('/category/edit/{id}','CategoryController@edit');
Route::post('/category/update/{id}','CategoryController@update');
Route::get('/category/destroy/{id}','CategoryController@destroy');
//商品表添加
Route::get('/goods/create','GoodsController@create');
Route::post('/goods/store','GoodsController@store');
//唯一性验证
Route::post('/goods/checkOnly','GoodsController@checkOnly');
Route::get('/goods','GoodsController@index');
Route::get('/goods/edit/{id}','GoodsController@edit');
Route::post('/goods/update/{id}','GoodsController@update');
Route::get('/goods/destroy/{id}','GoodsController@destroy');
//管理员表添加
Route::get('/admin/create','AdminController@create');
Route::post('/admin/store','AdminController@store');
//唯一性验证
Route::post('/admin/checkOnly','AdminController@checkOnly');
Route::get('/admin','AdminController@index');
Route::get('/admin/edit/{id}','AdminController@edit');
Route::post('/admin/update/{id}','AdminController@update');
Route::get('/admin/destroy/{id}','AdminController@destroy');
//周测
//登录
Route::get('/manage/create','ManageController@create');
Route::post('/manage/store','ManageController@store');
Route::get('/manage/index','ManageController@index');
Route::get('/manage/show','ManageController@show');
Route::get('/manage/delete/{id}','ManageController@delete');
Route::get('/manage/add','ManageController@add');
Route::post('/manage/add_do','ManageController@add_do');

//项目
Route::get('/','Index\IndexController@index');
Route::get('/prolist','Index\IndexController@prolist');
Route::get('/proinfo/{id}','Index\IndexController@proinfo');
Route::get('/cate/{id}','Index\IndexController@cate');
//加入购物车
Route::post('/cart/create','Index\CartController@create');
Route::get('/cart/car','Index\CartController@car');

//登录
Route::view('/login','index.login');
Route::post('/logindo','Index\LoginController@logindo');
//注册
Route::view('/register','index.register');
Route::post('/login/reg_do','Index\LoginController@reg_do');
// Route::post('/login/store','Index\LoginController@store');

//发送短信
Route::get('setcookie','Index\IndexController@setCookie');
Route::get('/send','Index\LoginController@ajaxsend');

//发送邮件
Route::get('/sendemail','Index\LoginController@sendEmail');