<!DOCTYPE html>
<html>

<head>
	@include('partials._head')
	@yield('stylesheet')
</head>
<body>
	
	@yield('title')
	{{-- @include('partials._nav') --}}
	<div id="container">

		@yield('content')
		
	</div>
	@yield('scripts')
</body>
</html>