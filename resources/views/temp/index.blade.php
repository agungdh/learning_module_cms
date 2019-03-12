<!DOCTYPE html>
<html>
<head>
	<title>Test Temp</title>
</head>
<body>
	{!! Form::open(['route' => 'temp.sendData', 'files' => true]) !!}
	{!! Form::file('data') !!}
	<br>
	<button type="submit">Submit</button>
	{!! Form::close() !!}
</body>
</html>