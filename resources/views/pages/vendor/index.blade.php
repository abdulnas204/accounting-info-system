@extends('main')
@section('stylesheet')
	<link rel="stylesheet" type="text/css" href="/css/customer.css">
@stop
@section('title')
	<h1>Manage Vendors</h1>
	<link rel="stylesheet" href="css/invoice.css">
@stop

@section('content')
	@if(\Session::has('feedback'))
		<p>{{ Session::get('feedback') }}</p>
	@endif
	<div class="row">
		<div class="col-md-6">
			<h2>Add a Vendor</h2>
			{{ Form::open(['route' => 'vendor.store']) }}
				@include('pages.vendor.form')
			{{ Form::close() }}
		</div>

		<div class="col-md-6">
			<h2>Vendors</h2>

			<ul>

			
			</ul>
		</div>
		
	</div>
	<div class="row">
		
		
	</div>

@stop

@section('scripts')
	<script src="js/invoice.js"></script>
@stop