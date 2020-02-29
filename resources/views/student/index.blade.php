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
	<center><h2>学生信息列表页面</h2></center><hr/>
	<form>
		<input type="text" name="sname" value="{{$sname}}" placeholder="请输入姓名">
		<input type="text" name="sclass" value="{{$sclass}}" placeholder="请输入班级">
		<input type="submit" value="搜索">
	</form>
	<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>姓名</th>
				<th>性别</th>
				<th>班级</th>
				<th>分数</th>
				<th>头像</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach($res as $k=>$v)
			<tr @if($k%2==0) class="active" @else class="success" @endif>
				<td>{{$v->sid}}</td>
				<td>{{$v->sname}}</td>
				<td>{{$v->sex==1?'男':'女'}}</td>
				<td>{{$v->sclass}}</td>
				<td>{{$v->score}}</td>
				<td>@if($v->s_img)<img src="{{env('UPLOAD_URL')}}{{$v->s_img}}" height="80px">@endif</td>
				<td>
					<a href="{{url('student/edit/'.$v->sid)}}" class="btn btn-info">编辑</a>
					 | 
					<a href="{{url('student/destroy/'.$v->sid)}}" class="btn btn-danger">删除</a>
				</td>
			</tr>
			@endforeach

			<tr>
				<td colspan="5">{{$res->appends(['sname'=>$sname,'sclass'=>$sclass])->links()}}</td>
			</tr>
		</tbody>
</table>
</div>  	

</body>
</html>