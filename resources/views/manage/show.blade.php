<h2>用户管理</h2>

@if(session('adminuser.is_manage')==1)
	<h3>欢迎库主管登录</h3>
	@else
	<h3>欢迎普通管理员登录</h3>
	@endif
<table border="1px">
	<tr>
		<td>用户id</td>
		<td>用户昵称</td>
		<td>用户身份</td>
		<td>操作</td>
	</tr>
	@foreach($res as $v)
	<tr>
		<td>{{$v->mid}}</td>
		<td>{{$v->m_number}}</td>
		<td>{{$v->is_manage==1?'库管主管':'普通库管员'}}</td>
		<td>
			<a href="{{url('/manage/add')}}">添加</a>
	@if(session('adminuser.is_manage')==1)
	@if($v->is_manage==2)
			<a href="{{url('/manage/delete/'.$v->mid)}}">删除</a>

			@endif
			@else
			无权限
			@endif
		</td>
	</tr>
	@endforeach
</table>