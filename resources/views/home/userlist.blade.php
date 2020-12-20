<!DOCTYPE html>
<html>
<head>
	<title>User list page</title>
</head>
<body>

	<h3>All User</h3>
	<a href="{{route('home.home')}}">Back</a> |
	<a href="/logout">logout</a>

	<br>
	<br>

	<table border="1">
		<tr>
			<td>ID</td>
			<td>NAME</td>
			<td>USERNAME</td>
			<td>CGPA</td>
			<td>Type</td>
			<td>Action</td>
		</tr>

		@for($i=0; $i < count($users); $i++)
		<tr>
			<td>{{$users[$i]['id']}}</td>
			<td>{{$users[$i]['username']}}</td>
			<td>{{$users[$i]['password']}}</td>
			<td>{{$users[$i]['name']}}</td>
			<td>{{$users[$i]['type']}}</td>
			<td>
				<a href="{{route('home.edit', $users[$i]['id'])}}">Edit</a> |
				<a href="/app/delete/{{$users[$i]['id']}}">Delete</a> 
			</td>
		</tr>
		@endfor
	</table>

</body>
</html>