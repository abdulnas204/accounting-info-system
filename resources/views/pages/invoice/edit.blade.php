invoice_@extends('main')
@section('stylesheet')
	<link rel="stylesheet" type="text/css" href="/css/invoice.css">
@stop
@section('title')
	Manage Invoices
@stop

@section('content')
	@if(\Session::has('feedback'))
		<p>{{ Session::get('feedback') }}</p>
	@endif
	<a href="{{ URL::previous() }}"><<<< Back</a>
	<div class="row">
		<div class="col-md-6">
			<h2>Edit Invoice</h2>
			{{ Form::model($invoice, ['route' => ['invoice.update', $invoice->invoice_id], 'method' => 'POST', 'id'=>'invoice-builder-form']) }}
				<input type="hidden" name="_method" value="PUT">
				{{ method_field('PUT') }}
				{{-- {{ csrf_field() }} --}}
				@include('pages.invoice.form')
			{{ Form::close() }}
		</div>
		
	</div>

@stop

@section('scripts')
	<script src="/js/invoice.js"></script>
@stop