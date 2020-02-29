<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h2>分类添加页面</h2>
	<form action="{{route('do')}}" method="post">
		@csrf
		<table>
			<tr>
				<td><input type="text" name="name"></td>
			</tr>
			<tr>
				<td><input type="text" name="age"></td>
			</tr>
			<tr>
				<td><input type="submit" value="添加"></td>
			</tr>
		</table>
	</form>
</body>
</html>