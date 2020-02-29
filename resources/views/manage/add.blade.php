<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h2>用户列表添加页面</h2>
	<form action="{{url('/manage/add_do')}}" method="post">
		@csrf
		<table border="1px">
			<tr>
				<td>账号</td>
				<td><input type="text" name="m_number"></td>
			</tr>
			<tr>
				<td>密码</td>
				<td><input type="text" name="m_pwd"></td>
			</tr>
			<tr>
				<td>是否是库管员</td>
				<td>
					<input type="radio" name="is_manage" value="1">是
					<input type="radio" name="is_manage" value="2">否
				</td>
			</tr>
			<tr>
				<td><input type="submit" value="添加"></td>
				<td></td>
			</tr>
		</table>
	</form>	
</body>
</html>