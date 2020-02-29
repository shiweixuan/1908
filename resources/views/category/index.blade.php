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
				<th>分类名称</th>
				<th>描述</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach($data as $k=>$v)
			<tr @if($k%2==0) class="active" @else class="success" @endif>
				<td>{{$v->cid}}</td>
				<td>{{str_repeat('--|',$v->level)}}{{$v->cname}}</td>
				<td>{{$v->describe}}</td>
				<td>
					<a href="{{url('/category/edit/'.$v->cid)}}" class="btn btn-info">编辑</a>
					 | 
					<a href="javascript:void(0)" onclick="del('{{$v->cid}}')" class="btn btn-danger">删除</a>
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
			$.get('/category/destroy/'+id,function(result){
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