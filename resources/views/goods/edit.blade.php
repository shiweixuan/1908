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
	<center><h2>商品编辑页面</h2></center><hr/>
<form action="{{url('/goods/update/'.$res->g_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" 
				   placeholder="请输入商品名称" name="g_name" value="{{$res->g_name}}">
		<b style="color:red">{{$errors->first('g_name')}}</b>
		</div>
	</div>

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品货号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" 
				   placeholder="请输入商品货号" name="g_num" value="{{$res->g_num}}">
		<b style="color:red">{{$errors->first('g_num')}}</b>
		</div>
	</div>

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" 
				   placeholder="请输入商品价格" name="g_price" value="{{$res->g_price}}">
		<b style="color:red">{{$errors->first('g_price')}}</b>
		</div>
	</div>

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品图片</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" id="firstname" 
				   name="g_img" value="{{$res->g_img}}">
		</div>
	</div>

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品库存</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" 
				   placeholder="请输入商品库存" name="g_number" value="{{$res->g_number}}">
		<b style="color:red">{{$errors->first('g_number')}}</b>
		</div>
	</div>

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否精品</label>
		<div class="col-sm-10">
			<input type="radio"  id="firstname" value="1" name="is_best" @if($res->is_best==1) checked @endif>是
			<input type="radio"  id="firstname" value="2" name="is_best" @if($res->is_best==2) checked @endif>否
			<b style="color:red">{{$errors->first('is_best')}}</b>
		</div>
	</div>

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否热卖</label>
		<div class="col-sm-10">
			<input type="radio"  id="firstname" value="1" name="is_hot" @if($res->is_hot==1) checked @endif>是
			<input type="radio"  id="firstname" value="2" name="is_hot" @if($res->is_hot==2) checked @endif>否
			<b style="color:red">{{$errors->first('is_hot')}}</b>
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品描述</label>
		<div class="col-sm-10">
			<textarea class="form-control" id="lastname" name="g_describe">{{$res->g_describe}}</textarea>
		</div>
	</div>

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品相册</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" id="firstname" 
				   name="g_imgs[]" multiple value="{{$res->g_imgs}}">
		</div>
	</div>

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌</label>
		<div class="col-sm-10">
			<select name="bid">
				<option value="0">--请选择!--</option>
				@foreach($brandInfo as $v)
				<option value="{{$v->bid}}">{{$v->bname}}</option>
				@endforeach
			</select>
		</div>
	</div>

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-10">
			<select name="cid">
				<option value="0">--请选择!--</option>	
				@foreach($data as $v)		
				<option value="{{$v->cid}}">{{str_repeat('--|',$v->level)}}{{$v->cname}}</option>	
				@endforeach	
			</select>
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
		$("input[name='g_name']").next().html('');
		var g_name=$("input[name='g_name']").val();
		var reg=/^[\u4e00-\u9fa50-9A-Za-z_]+$/;
		if(!reg.test(g_name)){
			$('input[name="g_name"]').next().html('分类名称由文字母数字组成且不能为空');
			return;
		}

		//验证唯一性
		$.ajax({
			type:'post',
			url:"/goods/checkOnly",
			data:{g_name:g_name},
			async:false,
			dataType:'json',
			success:function(result){
				if(result.count>0){
					$("input[name='g_name']").next().html('商品名称已存在');
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


	$("input[name='g_name']").blur(function(){
		$(this).next().html('');
		var g_name=$(this).val();
		var reg=/^[\u4e00-\u9fa50-9A-Za-z_]+$/;
		if(!reg.test(g_name)){
			$(this).next().html('商品名称由文字母数字组成且不能为空');
			return;
		}
		$.ajaxSetup({headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

		//验证唯一性
		$.ajax({
			type:'post',
			url:"/goods/checkOnly",
			data:{g_name:g_name},
			dataType:'json',
			success:function(result){
				if(result.count>0){
					$("input[name='g_name']").next().html('商品名称已存在');
				}
			}
		})
	})
</script> -->

</body>
</html>