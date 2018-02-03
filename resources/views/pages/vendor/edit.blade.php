@extends('main')
@section('stylesheet')
	<link rel="stylesheet" type="text/css" href="/css/customer.css">
@stop
@section('title')
	<h1>Manage Invoices</h1>

@stop

@section('content')
	@if(\Session::has('feedback'))
		<p>{{ Session::get('feedback') }}</p>
	@endif
	<div class="row">
		<div class="col-md-6">
			<h2>Add Invoice</h2>
			{{ Form::open(['route' => 'invoice.store']) }}
				<input type="hidden" name="_method" value="PUT">
				{{ method_field('PUT') }}
				@include('pages.invoice.form')
			{{ Form::close() }}
		</div>
		<div class="col-md-6">
			<h2>Invoice List</h2>
			<ol>
			
			</ol>
		</div>
	</div>

@stop

@section('scripts')
	<script src="js/ledger-script.js"></script>
@stop