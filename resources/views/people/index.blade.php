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
	<center><h2>外来务工人员列表页面</h2></center><hr/>
	<form action="">
		<input type="text" name="wname" value="{{$wname}}" placeholder="请输入姓名">
		<input type="submit" value="搜索">
	</form>
	<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>姓名</th>
				<th>年龄</th>
				<th>身份证号</th>
				<th>居住地</th>
				<th>是否是湖北人</th>
				<th>头像</th>
				<th>添加时间</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $k=>$v)
			<tr @if($k%2==0) class="active" @else class="success" @endif>
				<td>{{$v->wid}}</td>
				<td>{{$v->wname}}</td>
				<td>{{$v->wage}}</td>
				<td>{{$v->wcard}}</td>
				<td>{{$v->is_hubei==1?'√':'×'}}</td>
				<td>{{$v->waddress}}</td>
				<td>@if($v->w_img)<img src="{{env('UPLOAD_URL')}}{{$v->w_img}}" height="80px">@endif</td>
				<td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
				<td>
					<a href="{{url('/people/edit/'.$v->wid)}}" class="btn btn-info">编辑</a>
					 | 
					<a href="{{url('/people/destroy/'.$v->wid)}}" class="btn btn-danger">删除</a>
				</td>
			</tr>
			@endforeach

			<tr>
				<td colspan="7">{{$data->appends(['wname'=>$wname])->links()}}</td>
			</tr>
		</tbody>
</table>
</div>  	

</body>
</html>