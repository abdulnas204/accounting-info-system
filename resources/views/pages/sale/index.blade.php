@extends('main')
@section('stylesheet')
	<link rel="stylesheet" type="text/css" href="/css/sale.css">
	<link rel="stylesheet" href="css/sale.css">
@stop
@section('title')
Manage Sales
@stop

@section('content')
	@if(\Session::has('feedback'))
		<p>{{ Session::get('feedback') }}</p>
	@endif

	<div class="row">
		<div class="col-md-6">
			<h2>Add Sale</h2>
			{{ Form::open(['route' => 'sale.store', 'id'=>'sale-builder-form']) }}
				@include('pages.sale.form')
			{{ Form::close() }}
		</div>
		<div class="col-md-6">
			<h2>Information</h2>
			<div class="form-feedback">
				
			</div>
		</div>
	</div>
	<div class="row">
		
		<div class="col-md-12">
			<h2>Sale List</h2>
			<table>
			
			</table>
			<ul>

			
			</ul>
		</div>
	</div>

@stop

@section('scripts')
	<script src="/js/modules/customer-preview.js"></script>
	<script src="js/sale.js"></script>
@stop