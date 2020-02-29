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
	<center><h2>管理员编辑页面</h2></center><hr/>
<form action="{{url('/admin/update/'.$res->a_id)}}" method="post" class="form-horizontal" role="form">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">管理员名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" 
				   placeholder="请输入管理员名称" name="a_name" value="{{$res->a_name}}">
		<b style="color:red">{{$errors->first('a_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">密码</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" id="firstname" 
				   placeholder="请输入密码" name="a_pwd" value="{{$res->a_pwd}}">
		<b style="color:red">{{$errors->first('a_pwd')}}</b>
		</div>
	</div>
	
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">手机号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" 
				   placeholder="请输入手机号" name="a_tel" value="{{$res->a_tel}}">
		<b style="color:red">{{$errors->first('a_tel')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">邮箱</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" 
				   placeholder="请输入邮箱" name="a_email" value="{{$res->a_email}}">
		<b style="color:red">{{$errors->first('a_email')}}</b>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<input type="submit" value="编辑">
		</div>
	</div>
</form>

<!-- <script>
	$('input[type="button"]').click(function(){
		var titleflag=true;
		//标题验证
		$("input[name='a_name']").next().html('');
		var a_name=$("input[name='a_name']").val();
		var reg=/^[\u4e00-\u9fa50-9A-Za-z_]+$/;
		if(!reg.test(a_name)){
			$('input[name="a_name"]').next().html('管理员名称名称由文字母数字组成且不能为空');
			return;
		}

		//验证唯一性
		$.ajax({
			type:'post',
			url:"/admin/checkOnly",
			data:{a_name:a_name},
			async:false,
			dataType:'json',
			success:function(result){
				if(result.count>0){
					$("input[name='a_name']").next().html('管理员名称已存在');
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


	$("input[name='a_name']").blur(function(){
		$(this).next().html('');
		var a_name=$(this).val();
		var reg=/^[\u4e00-\u9fa50-9A-Za-z_]+$/;
		if(!reg.test(a_name)){
			$(this).next().html('分类名称由文字母数字组成且不能为空');
			return;
		}
		$.ajaxSetup({headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

		//验证唯一性
		$.ajax({
			type:'post',
			url:"/admin/checkOnly",
			data:{a_name:a_name},
			dataType:'json',
			success:function(result){
				if(result.count>0){
					$("input[name='a_name']").next().html('管理员名称已存在');
				}
			}
		})
	})
</script> -->

</body>
</html>