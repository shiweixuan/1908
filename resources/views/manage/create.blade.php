<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>登录</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>登录页面</h2></center><hr/>

@if($errors->any())
<div class="alert alert-danger">
<ul>
@foreach($errors->all() as $error)	
<li>{{$error}}</li>
@endforeach
</ul>
</div>
@endif
<center><b style="color:red">{{session('msg')}}</b></center>
<form action="{{url('manage/store')}}" method="post" class="form-horizontal" role="form">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">账号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" 
				   placeholder="请输入账号" name="m_number">
			<b style="color:red">{{$errors->first('m_number')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">密码</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" id="lastname" 
				   placeholder="请输入密码" name="m_pwd">
		<b style="color:red">{{$errors->first('m_pwd')}}</b>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">登录</button>
		</div>
	</div>
</form>

</body>
</html> 