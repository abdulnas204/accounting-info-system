@extends('main')
@section('stylesheet')
	<link rel="stylesheet" href="css/inventory.css">
@stop
@section('title')
	Manage inventorys
@stop

@section('content')
	@if(\Session::has('feedback'))
		<p>{{ \Session::get('feedback') }}</p>
	@endif

	<div class="row">
		<div class="col-md-6">
			<h2>Add inventory</h2>
			{{ Form::open(['route' => 'inventory.store', 'id'=>'inventory-builder-form']) }}
				@include('pages.inventory.form')
			{{ Form::close() }}
		</div>
		<div class="col-md-6">
			<h2>Information</h2>
			<div class="form-feedback">
				
			</div>
		</div>
	</div>

@stop

@section('scripts')
	<script src="/js/modules/customer-preview.js"></script>
	<script src="/js/inventory.js"></script>
@stop