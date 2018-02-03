	<meta class="csrf-token" name="csrf-token" content="{{ csrf_token() }}">
	
	<div class="form-group">
	{{ Form::label('name', 'Name') }}
	{{ Form::text('name') }}
	</div>

	{{-- <div class="form-group">
	{{ Form::label('customer_id', 'Customer ID') }}
	{{ Form::text('customer_id') }}
	</div> --}}

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
	
	{{-- <div class="form-group">
	{{ Form::label('order_id', 'Order ID') }}
	{{ Form::text('order_id') }}
	</div> --}}
	
	{{-- <div class="form-group">
	{{ Form::label('amount', 'Amount') }}
	{{ Form::text('amount') }}
	</div>

	<div class="form-group">
	{{ Form::label('due_date', 'Due Date') }}
	{{ Form::text('due_date') }}
	</div> --}}

	<div class="form-group">
	{{ Form::label('description', 'Description') }}
	{{ Form::text('description') }}
	</div>
	
	<div class="form-group">
	{{ Form::submit('Submit') }}
		
	</div>
