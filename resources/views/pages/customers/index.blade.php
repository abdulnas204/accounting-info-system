@extends('main')
@section('stylesheet')
	<link rel="stylesheet" type="text/css" href="/css/customer.css">
@stop
@section('title')
	<h1>Add Customer</h1>

@stop

@section('content')
<div id="customer-view-container">
	
	@if(\Session::has('feedback'))
		<p>{{ Session::get('feedback') }}</p>
	@endif
		
		<div class="customer-form">

			{{ Form::open(['route' => 'customers.store']) }}
				@include('pages.customers.form')
			{{ Form::close() }}
		</div>
</div>

@stop

@section('scripts')
	<script src="js/ledger-script.js"></script>
@stop