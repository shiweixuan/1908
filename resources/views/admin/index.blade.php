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
	<center><h2>分类列表页面</h2></center><hr/>
	

	<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>管理员名称</th>
				<th>手机号</th>
				<th>邮箱</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach($res as $k=>$v)
			<tr @if($k%2==0) class="active" @else class="success" @endif>
				<td>{{$v->a_id}}</td>
				<td>{{$v->a_name}}</td>
				<td>{{$v->a_tel}}</td>
				<td>{{$v->a_email}}</td>
				<td>
					<a href="{{url('/admin/edit/'.$v->a_id)}}" class="btn btn-info">编辑</a>
					 | 
					<a href="javascript:void(0)" onclick="del('{{$v->a_id}}')" class="btn btn-danger">删除</a>
				</td>
			</tr>
			@endforeach
			
		</tbody>
</table>
<script>
	function del(id){
		if(!id){
			return;
		}
		if(confirm('是否删除此条记录')){
			$.get('/admin/destroy/'+id,function(result){
				if(result.code=='00000'){
					location.reload();
				}
			},'json')
		}
	}
</script>
</div>  	

</body>
</html>