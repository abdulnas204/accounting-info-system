@extends('pages.setting.index')

@section('title')
Taxes
@stop

@section('sidenav')

@stop

@section('tab')
@if(\Session::has('feedback'))
	<p>{{ Session::get('feedback') }}</p>
@endif

<p>Most information is used for various reports for your viewing only.  None of this data is or can be shared unless you publicly open the platform.  All information is optional.</p>
{{-- {{ Form::model($taxes, ['url' => ['/setting/general/' . $taxes['tax_id'] . '/update'], 'method' => 'POST', 'id'=>'general-settings-form']) }} --}}
	{{ Form::open(['url' => '/setting/taxes/add', 'id' => 'tax-option-form']) }}
	<br>
	<h2>Add New Tax</h2>

	<div class="form-row">
		<div class="col-md-6">
			{{ Form::label('name', 'Name of tax') }}
		</div>
		<div class="col-md-6">
			{{ Form::text('name') }}
		</div>
	</div>

	<div class="form-row">
		<div class="col-md-6">
			{{ Form::label('percentage', 'Percentage') }}
		</div>
		<div class="col-md-6">
			{{ Form::text('percentage') }}
		</div>
	</div>

	<div class="form-row">
		
	</div>

	<hr style="height: 1px; width: 100%;">

	{{-- {{ Form::hidden('company_id', $company_id, ['id'=> 'company_id']) }} --}}
	<div class="form-row">
		<div class="col-md-12">
			{{ Form::submit('Submit', ['id'=> 'submit-form-button']) }}
		</div>
	</div>


{{ Form::close() }}
	<br>
	<h2>Existing Taxes</h2>
	<table id='table-existing-entries'>
		<thead>
			<tr>
				<th>Manage</th>
				<th>Name of tax</th>
				<th>Percentage (%)</th>
			</tr>
		</thead>
		<tbody>
		@foreach($taxes as $tax)
			<tr>
				<td></td>
				<td>{{ $tax['name'] }}</td>
				<td>{{ $tax['percentage'] }}</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	
@stop