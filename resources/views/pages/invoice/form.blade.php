
	<div class="form-group">
	{{ Form::label('name', 'Name') }}
	{{ Form::text('name') }}
	</div>
	
	<div class="form-group">
	{{ Form::label('company', 'Company') }}
	{{ Form::text('company') }}
	</div>
	
	<div class="form-group">
	{{ Form::label('email', 'Email') }}
	{{ Form::text('email') }}
	</div>
	
	<div class="form-group">
	{{ Form::label('address', 'Address') }}
	{{ Form::text('address') }}
	</div>
	
	<div class="form-group">
	{{ Form::label('phone', 'Phone Number') }}
	{{ Form::text('phone') }}
	</div>

	<div class="form-group">
	{{ Form::label('amount', 'Amount') }}
	{{ Form::text('amount') }}
	</div>

	<div class="form-group">
	{{ Form::label('due_date', 'Due Date') }}
	{{ Form::text('due_date') }}
	</div>
	
	<div class="form-group">
	{{ Form::submit('Submit') }}
		
	</div>
