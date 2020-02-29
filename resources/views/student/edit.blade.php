<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
	<center><h2>学生信息编辑页面</h2></center><hr/>

@if($errors->any())
<div class="alert alert-danger">
<ul>
@foreach($errors->all() as $error)	
<li>{{$error}}</li>
@endforeach
</ul>
</div>
@endif

<form action="{{url('student/update/'.$res->sid)}}" method="post" class="form-horizontal" role="form">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">姓名</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" 
				   placeholder="请输入姓名" name="sname" value="{{$res->sname}}">
			<b style="color:red">{{$errors->first('sname')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">班级</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="lastname" 
				   placeholder="请输入所在班级" name="sclass" value="{{$res->sclass}}">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">性别</label>
		<div class="col-sm-10">
			<input type="radio"  id="firstname" value="1" name="sex" @if($res->sex==1) checked @endif>男
			<input type="radio"  id="firstname" value="2" name="sex" @if($res->sex==2) checked @endif>女
			<b style="color:red">{{$errors->first('sex')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">分数</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="lastname" name="score" value="{{$res->score}}">
			<b style="color:red">{{$errors->first('score')}}</b>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">编辑</button>
		</div>
	</div>
</form>

</body>
</html>