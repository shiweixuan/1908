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
	<center><h2>外来务工人员编辑页面</h2></center><hr/>
<form action="{{url('/people/update/'.$res->wid)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">名字</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" 
				   placeholder="请输入名字" name="wname" value="{{$res->wname}}">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">年龄</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="lastname" 
				   placeholder="请输入年龄" name="wage" value="{{$res->wage}}">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">身份证号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="lastname" 
				   placeholder="请输入身份证号" name="wcard" value="{{$res->wcard}}">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">居住地</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="lastname" 
				   placeholder="请输入居住地" name="waddress" value="{{$res->waddress}}">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否是湖北人</label>
		<div class="col-sm-10">
			<input type="radio"  id="firstname" value="1" name="is_hubei" @if($res->is_hubei==1) checked @endif>是
			<input type="radio"  id="firstname" value="2" name="is_hubei" @if($res->is_hubei==2) checked @endif>否
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">头像</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" id="lastname" name="w_img">
			<img src="{{env('UPLOAD_URL')}}{{$res->w_img}}" height="50px">
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