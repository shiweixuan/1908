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
	<center><h2>品牌编辑页面</h2></center><hr/>
<form action="{{url('brand/update/'.$res->bid)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" 
				   placeholder="请输入品牌名称" name="bname" value="{{$res->bname}}">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">图片</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" id="lastname" name="bimg">
			<img src="{{env('UPLOAD_URL')}}{{$res->bimg}}" height="50px">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网址</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="lastname" name="burl" value="{{$res->burl}}">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">内容</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="lastname" name="bcontent" value="{{$res->bcontent}}">
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