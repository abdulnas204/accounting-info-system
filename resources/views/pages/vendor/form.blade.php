	{{-- <meta class="csrf-token" name="csrf-token" content="{{ csrf_token() }}"> --}}

	<div class="form-row">
		<div class="col-md-6">
			{{ Form::label('name', 'Name') }}
		</div>
		<div class="col-md-6">
			{{ Form::text('name') }}
		</div>
	</div>

	<div class="form-row">
		<div class="col-md-6">
			{{ Form::label('company', 'Company') }}
		</div>
		<div class="col-md-6">
			{{ Form::text('company') }}
		</div>
	</div>

	<div class="form-row">
		<div class="col-md-6">
			{{ Form::label('email', 'Email') }}
		</div>
		<div class="col-md-6">
			{{ Form::text('email') }}
		</div>
	</div>
	
	<div class="form-row">
		<div class="col-md-6">
			{{ Form::label('address', 'Address') }}
		</div>
		<div class="col-md-6">
			{{ Form::text('address') }}
		</div>
	</div>

	<div class="form-row">
		<div class="col-md-6">
			{{ Form::label('phone_number', 'Phone Number') }}
		</div>
		<div class="col-md-6">
			{{ Form::text('phone_number') }}
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
		<div class="col-md-6">
			{{ Form::label('state', 'State') }}
		</div>
		<div class="col-md-6">
			@include('partials._list_of_states')
		</div>	
	</div>

	<div class="form-row">
		<div class="col-md-6">
			{{ Form::label('zip', 'Zip Code') }}
		</div>	
		<div class="col-md-6">
			{{ Form::text('zip') }}
		</div>
	</div>
	
	<div class="form-row">
		<div class="col-md-6">
			{{ Form::label('country', 'Country') }}
		</div>	
		<div class="col-md-6">
			{{ Form::text('country') }}
		</div>
	</div>

	<div class="form-row">
		<div class="col-md-6">
			{{ Form::label('notes', 'Notes') }}
		</div>
		<div class="col-md-6">
			{{ Form::text('notes') }}
		</div>
	</div>


	<hr style="height: 1px; width: 100%;">

	<div class="form-row">
		<div class="col-md-12">
			{{ Form::submit('Submit', ['id' => 'submit-form-button']) }}
		</div>

	</div>
