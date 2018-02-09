@extends('pages.setting.index')

@section('title')
General
@stop

@section('sidenav')

@stop

@section('tab')

<p>Most information is used for various reports for your viewing only.  None of this data is or can be shared unless you publicly open the platform.  All information is optional.</p>
{{ Form::open(['route' => 'customer.store', 'id'=>'customer-builder-form', 'onsubmit' => 'return formValidator()']) }}
	<br>
	<h2>General Information</h2>
	<div class="form-row">
		<div class="col-md-6">
			{{ Form::label('company_name', 'Company Name') }}
		</div>	
		<div class="col-md-6">
			{{ Form::text('company_name') }}
		</div>
	</div>

	<div class="form-row">
		<div class="col-md-6">
			{{ Form::label('owner_name', 'Owner Name(s) (separate by commas)') }}
		</div>	
		<div class="col-md-6">
			{{ Form::text('owner_name') }}
		</div>
	</div>

	<div class="form-row">
		<div class="col-md-6">
			{{ Form::label('city', 'City') }}
		</div>	
		<div class="col-md-6">
			{{ Form::text('city') }}
		</div>
	</div>


	<div class="form-row">
		<div class="form-row">
			<div class="col-md-6">
				{{ Form::label('state', 'State of incorporation/business') }}
			</div>
			<div class="col-md-6">
				@include('partials._list_of_states')
			</div>	
		</div>
	</div>
	<div class="form-row">
		<div class="col-md-6">
			
			{{ Form::label('start_date', 'Start Date of Business') }}
		</div>
		<div class="col-md-6">
			<div class="input-group">
				@php 
				if(isset($invoice)) { $default = $invoice['start_date']; } else { $default = ''; } 
				@endphp
				{{ Form::text('start_date', $default, ['class'=> 'with-button']) }}
				<div class="input-group-append">
					<span class="fake-button btn btn-outline-primary show-calendar text-button">[ ]</span>
				</div>
			</div>
		</div>
	</div>

	<br>
	<h2>Preferences</h2>
	<div class="form-row">
		
	</div>

	<hr style="height: 1px; width: 100%;">

	<div class="form-row">
		<div class="col-md-12">
			{{ Form::submit('Submit', ['id'=> 'submit-form-button']) }}
		</div>
	</div>


	</div>
{{ Form::close() }}
@stop