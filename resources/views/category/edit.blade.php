<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
	<center><h2>分类编辑页面</h2></center><hr/>
<form action="{{url('category/update/'.$res->cid)}}" method="post" class="form-horizontal" role="form">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" 
				   placeholder="请输入分类名称" name="cname" value="{{$res->cname}}">
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">顶级分类</label>
		<div class="col-sm-10">
			<select name="pid">
				<option value="0">顶级分类</option>
				@foreach($data as $v)
				<option value="{{$v->cid}}">{{str_repeat('--|',$v->level)}}{{$v->cname}}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">描述</label>
		<div class="col-sm-10">
			<textarea class="form-control" id="lastname" name="describe">{{$res->describe}}</textarea>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<input type="button" value="编辑">
		</div>
	</div>
</form>

<script>
	//定义全局变量aid
	var cid="{{$res->cid}}";
	$('input[type="button"]').click(function(){
		var titleflag=true;
		//标题验证
		$("input[name='cname']").next().html('');
		var cname=$("input[name='cname']").val();
		var reg=/^[\u4e00-\u9fa50-9A-Za-z_]+$/;
		if(!reg.test(cname)){
			$('input[name="cname"]').next().html('分类名称由文字母数字组成且不能为空');
			return;
		}

		//验证唯一性
		$.ajax({
			type:'post',
			url:"/category/checkOnly",
			data:{cname:cname,cid:cid},
			async:false,
			dataType:'json',
			success:function(result){
				if(result.count>0){
					$("input[name='cname']").next().html('分类名称已存在');
					titleflag=false;
				}
			}
		});
		if(!titleflag){
			return;
		}

		//form提交
		$('form').submit();
	});

	$("input[name='cname']").blur(function(){
		$(this).next().html('');
		var cname=$(this).val();
		var reg=/^[\u4e00-\u9fa50-9A-Za-z_]+$/;
		if(!reg.test(cname)){
			$(this).next().html('分类名称由文字母数字组成且不能为空');
			return;
		}
		$.ajaxSetup({headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

		//验证唯一性
		$.ajax({
			type:'post',
			url:"/category/checkOnly",
			data:{cname:cname,cid:cid},
			dataType:'json',
			success:function(result){
				if(result.count>0){
					$("input[name='cname']").next().html('分类名称已存在');
				}
			}
		})
	})
</script>

</body>
</html>