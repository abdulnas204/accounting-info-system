
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
			{{ Form::label('phone', 'Phone Number') }}
		</div>	
		<div class="col-md-6">
			{{ Form::text('phone') }}
		</div>
	</div>
	
	<div class="form-row">
		<div class="col-md-6">
			{{ Form::label('state', 'State') }}
		</div>	
		<div class="col-md-6">
			{{ Form::text('state') }}
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
	
	<div class="form-row">
		<div class="col-md-12">
			{{ Form::submit('Submit') }}
		</div>
	</div>
