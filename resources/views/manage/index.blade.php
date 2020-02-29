<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h2>库存管理系统</h2>
	@if(session('adminuser.is_manage')==1)
	<h3>欢迎库主管登录</h3>
	@else
	<h3>欢迎普通管理员登录</h3>
	@endif
	@if(session('adminuser.is_manage')==1)
	<a href="{{url('/manage/show')}}">用户管理</a>
	@endif
	<a href="">货物管理</a>
	<a href="">出入库记录管理</a>
</body>
</html>