<!DOCTYPE html>
<html>

<head>
	@include('partials._head')

	@yield('stylesheet')

	<link rel="stylesheet" type="text/css" href="/css/main.css">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
	@include('partials._nav')

	@yield('title')

	<div id="container" class="container">

		@yield('content')
		
	</div>
	
	@yield('scripts')
</body>
</html>