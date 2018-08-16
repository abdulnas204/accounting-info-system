<!DOCTYPE html>
<html>

<head>
	@include('partials._head')

	@yield('stylesheet')



	<link href="https://fonts.googleapis.com/css?family=Quattrocento" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
	<link rel="stylesheet" type="text/css" href="/css/main.css">

</head>

<body>
	@if(Session::has('message'))
		<div id="status-message">
			<p>{{ Session::get('message') }}</p>
		</div>
	@endif
	<div id="container" class="container">
		{{-- @include('partials._company') --}}
		@include('partials._nav')
		<h1 id="title">@yield('title')</h1>
	
	
		<div id='content'>
			@yield('content')
		</div>	
		
	</div>
	
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js'></script>
	<script src='/js/main.js'></script>
	<script src='/js/utils.js'></script>
	<script src='/js/modules/calendar.js'></script>
	<script src="/js/Chart.bundle.min.js"></script>
	<script src="/js/Chart.min.js"></script>
	@yield('scripts')
</body>
</html>
