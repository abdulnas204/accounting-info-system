@extends('main')
@section('stylesheet')
	<link rel="stylesheet" type="text/css" href="/css/vendor.css">
@stop
@section('title')
	<h1>Manage Vendors</h1>

@stop

@section('content')
<div id="vendor-view-container">
	@if(\Session::has('feedback'))
		<p>{{ Session::get('feedback') }}</p>
	@endif

	<a href="{{ URL::previous() }}"><<<< Back</a>
	<div class="row">
		<div class="col-md-6">
			<h2>Edit Vendor</h2>
			{{ Form::model($vendor, ['route' => ['vendor.update', $vendor->id], 'method' => 'POST', 'id'=>'vendor-builder-form']) }}
				<input type="hidden" name="_method" value="PUT">
				{{ method_field('PUT') }}
				{{-- {{ csrf_field() }} --}}
				@include('pages.vendor.form')
			{{ Form::close() }}
		</div>
		{{-- <div class="col-md-6">
			<h2>Vendor List</h2>
			<ol>
			
			</ol>
		</div> --}}
	</div>
</div>

@stop

@section('scripts')
	<script src="/js/vendor.js"></script>
@stop