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
<center><h2>编辑页面</h2></center><hr/>

<!-- @if($errors->any())
<div class="alert alert-danger">
<ul>
@foreach($errors->all() as $error)	
<li>{{$error}}</li>
@endforeach
</ul>
</div>
@endif -->

<form action="{{url('/artical/update/'.$res->aid)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章标题</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" 
				   placeholder="请输入文章标题" name="atitle" value="{{$res->atitle}}">
			<b style="color:red">{{$errors->first('atitle')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章分类</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="lastname" 
				   placeholder="请输入分类名称" name="acate" value="{{$res->acate}}">
		<b style="color:red">{{$errors->first('acate')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章重要性</label>
		<div class="col-sm-10">
			<input type="radio"  id="firstname" value="1" name="is_important" @if($res->is_important==1) checked @endif>普通
			<input type="radio"  id="firstname" value="2" name="is_important" @if($res->is_important==2) checked @endif>置顶
			<b style="color:red">{{$errors->first('is_important')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
			<input type="radio"  id="firstname" value="1" name="is_show" @if($res->is_show==1) checked @endif>显示
			<input type="radio"  id="firstname" value="2" name="is_show" @if($res->is_show==2) checked @endif>不显示
			<b style="color:red">{{$errors->first('is_show')}}</b>
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
	var aid="{{$res->aid}}";
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
			data:{atitle:atitle,aid:aid},
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

		//form提交
		$('form').submit();
	});

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
			data:{atitle:atitle,aid:aid},
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