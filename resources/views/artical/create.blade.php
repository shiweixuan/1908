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
<center><h2>添加页面</h2></center><hr/>

<!-- @if($errors->any())
<div class="alert alert-danger">
<ul>
@foreach($errors->all() as $error)	
<li>{{$error}}</li>
@endforeach
</ul>
</div>
@endif -->

<form action="{{url('/artical/store')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章标题</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" 
				   placeholder="请输入文章标题" name="atitle">
			<b style="color:red">{{$errors->first('atitle')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章分类</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="lastname" 
				   placeholder="请输入分类名称" name="acate">
		<b style="color:red">{{$errors->first('acate')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章重要性</label>
		<div class="col-sm-10">
			<input type="radio"  id="firstname" value="1" name="is_important">普通
			<input type="radio"  id="firstname" value="2" name="is_important" checked>置顶
			<b style="color:red">{{$errors->first('is_important')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
			<input type="radio"  id="firstname" value="1" name="is_show">显示
			<input type="radio"  id="firstname" value="2" name="is_show" checked>不显示
			<b style="color:red">{{$errors->first('is_show')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章作者</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="lastname" 
				   placeholder="请输入作者" name="author">
		<b style="color:red">{{$errors->first('author')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">作者email</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="lastname" 
				   placeholder="请输入作者邮箱" name="email">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">关键字</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="lastname" 
				   placeholder="请输入关键字" name="extends">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">网页描述</label>
		<div class="col-sm-10">
			<textarea name="content"></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">上传文件</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" id="lastname" name="a_img">
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<input type="button" value="添加">
		</div>
	</div>
</form>
<script>
	$('input[type="button"]').click(function(){
		var titleflag=true;
		//标题验证
		$("input[name='atitle']").next().html('');
		var atitle=$("input[name='atitle']").val();
		var reg=/^[\u4e00-\u9fa50-9A-Za-z_]+$/;
		if(!reg.test(atitle)){
			$('input[name="atitle"]').next().html('文章标题由文字母数字组成且不能为空');
			return;
		}

		//验证唯一性
		$.ajax({
			type:'post',
			url:"/artical/checkOnly",
			data:{atitle:atitle},
			async:false,
			dataType:'json',
			success:function(result){
				if(result.count>0){
					$("input[name='atitle']").next().html('标题已存在');
					titleflag=false;
				}
			}
		});
		if(!titleflag){
			return;
		}

		//作者验证
		var author=$("input[name='author']").val();
		var reg=/^[\u4e00-\u9fa50-9A-Za-z_]{2,8}$/;
		if(!reg.test(author)){
			$("input[name='author']").next().html('文章标题由文字母数字组成且长度为2-8位');
			return;
		}
		//form提交
		$('form').submit();
	});

	$("input[name='author']").blur(function(){
		$(this).next().html('');
		var author=$(this).val();
		var reg=/^[\u4e00-\u9fa50-9A-Za-z_]{2,8}$/;
		if(!reg.test(author)){
			$(this).next().html('文章标题由文字母数字组成且长度为2-8位');
			return;
		}
	})

	$("input[name='atitle']").blur(function(){
		$(this).next().html('');
		var atitle=$(this).val();
		var reg=/^[\u4e00-\u9fa50-9A-Za-z_]+$/;
		if(!reg.test(atitle)){
			$(this).next().html('文章标题由文字母数字组成且不能为空');
			return;
		}
		$.ajaxSetup({headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

		//验证唯一性
		$.ajax({
			type:'post',
			url:"/artical/checkOnly",
			data:{atitle:atitle},
			dataType:'json',
			success:function(result){
				if(result.count>0){
					$("input[name='atitle']").next().html('标题已存在');
				}
			}
		})
	})
</script>
</body>
</html>