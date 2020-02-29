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
	<center><h2>商品列表页面</h2></center><hr/>
	

	<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>商品名称</th>
				<th>商品货号</th>
				<th>商品价格</th>
				<th>商品图片</th>
				<th>商品库存</th>
				<th>是否精品</th>
				<th>是否热卖</th>
				<th>商品描述</th>
				<th>相册</th>
				<th>品牌</th>
				<th>分类名称</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach($res as $k=>$v)
			<tr @if($k%2==0) class="active" @else class="success" @endif>
				<td>{{$v->g_id}}</td>
				<td>{{$v->g_name}}</td>
				<td>{{$v->g_num}}</td>
				<td>{{$v->g_price}}</td>
				<td>@if($v->g_img)<img src="{{env('UPLOAD_URL')}}{{$v->g_img}}" height="80px">@endif</td>
				<td>{{$v->g_number}}</td>
				<td>{{$v->is_best==1?"是":"否"}}</td>
				<td>{{$v->is_hot==1?"是":"否"}}</td>
				<td>{{$v->g_describe}}</td>
				<td>
					@foreach($v->g_imgs as $val)
					<img src="{{env('UPLOAD_URL')}}{{$val}}" height="80px">
					@endforeach
				</td>
				<td>{{$v->bname}}</td>
				<td>{{str_repeat('--|',$v->level)}}{{$v->cname}}</td>
				<td>
					<a href="{{url('/goods/edit/'.$v->g_id)}}" class="btn btn-info">编辑</a>
					 | 
					<a href="javascript:void(0)" onclick="del('{{$v->g_id}}')" class="btn btn-danger">删除</a>
				</td>
			</tr>
			@endforeach
			
			<tr>
				<td colspan="12">{{$res->links()}}</td>
			</tr>
		</tbody>
</table>
<script>
	function del(id){
		if(!id){
			return;
		}
		if(confirm('是否删除此条记录')){
			$.get('/goods/destroy/'+id,function(result){
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