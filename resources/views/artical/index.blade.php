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
	<center><h2>文章列表页面</h2></center><hr/>
	
	<form action="">
		全部分类<input type="text" name="acate" value="{{$acate}}">
		文章标题<input type="text" name="atitle" value="{{$atitle}}">
		<input type="submit" value="搜索">
	</form>

	<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>编号</th>
				<th>文章标题</th>
				<th>文章分类</th>
				<th>文章重要性</th>
				<th>是否显示</th>
				<th>上传文件</th>
				<th>添加日期</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			@foreach($res as $k=>$v)
			<tr @if($k%2==0) class="active" @else class="success" @endif>
				<td>{{$v->aid}}</td>
				<td>{{$v->atitle}}</td>
				<td>{{$v->acate}}</td>
				<td>{{$v->is_important==2?'置顶':'普通'}}</td>
				<td>{{$v->is_show==1?'√':'×'}}</td>
				<td>@if($v->a_img)<img src="{{env('UPLOAD_URL')}}{{$v->a_img}}" height="80px">@endif</td>
				<td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
				<td>
					<a href="{{url('/artical/edit/'.$v->aid)}}" class="btn btn-info">编辑</a>
					 | 
					<a href="javascript:void(0)" onclick="del('{{$v->aid}}')" class="btn btn-danger">删除</a>
				</td>
			</tr>
			@endforeach
			
			<tr>
				<td colspan="5">{{$res->appends(['acate'=>$acate,'atitle'=>$atitle])->links()}}</td>
			</tr>
		</tbody>
</table>
<script>
	function del(id){
		if(!id){
			return;
		}
		if(confirm('是否删除此条记录')){
			$.get('/artical/destory/'+id,function(result){
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