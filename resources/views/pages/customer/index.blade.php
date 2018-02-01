@extends('main')
@section('stylesheet')
	<link rel="stylesheet" type="text/css" href="/css/customer.css">
@stop
@section('title')
	<h1>Manage Customers</h1>

@stop

@section('content')
<div id="customer-view-container">
	
	@if(\Session::has('feedback'))
		<p>{{ Session::get('feedback') }}</p>
	@endif
	<div class="row">
		<div class="customer-form col-md-6">
			<h2>Add a Customer</h2>
	
			{{ Form::open(['route' => 'customer.store']) }}
				@include('pages.customer.form')
			{{ Form::close() }}
		</div>

		<div id='customer-list' class="col-md-6">
			<h2>Customers</h2>
			@foreach($customers as $customer)
				<p>{{ $customer['name'] }}</p>
				<hr>
			@endforeach
		</div>
	</div>
</div>

@stop

@section('scripts')
@stop