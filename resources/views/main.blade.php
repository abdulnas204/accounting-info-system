<!DOCTYPE html>
<html>

<head>
	@include('partials._head')

	@yield('stylesheet')

	<link rel="stylesheet" type="text/css" href="/css/main.css">
</head>

<body>
	@include('partials._nav')

	@yield('title')

	<div id="container">

		@yield('content')
		
	</div>
	
	@yield('scripts')
</body>
</html>