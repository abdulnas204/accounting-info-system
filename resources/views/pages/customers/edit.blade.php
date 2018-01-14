@extends('main')

@section('stylesheet')
	<link rel="stylesheet" type="text/css" href="/css/customer.css">
@stop
@section('title')
	<h1>Edit Customer</h1>
@endsection

@section('content')
<div id="customer-view-container">
	@if(\Session::has('feedback'))
		<p>{{ Session::get('feedback') }}</p>
	@endif

	<div class="customer-form">
		{{ Form::model($customer, ['route' => ['customers.update', $customer->id], 'method' => 'POST']) }}
			<input type="hidden" name="_method" value="PUT">
			{{ method_field('PUT') }}
			@include('pages.customers.form')
		{{ Form::close() }}
	</div>

</div>

@endsection