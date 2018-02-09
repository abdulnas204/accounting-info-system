	
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
			
			{{ Form::label('customer_id', 'Customer ID') }}
		</div>
		<div class="col-md-6">
			{{ Form::text('customer_id') }}
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
			
			{{ Form::label('order_id', 'Order ID') }}
		</div>
		<div class="col-md-6">
			{{ Form::text('order_id') }}
		</div>
	</div>
	
	<div class="form-row">
		<div class="col-md-6">
			
			{{ Form::label('due_date', 'Due Date') }}
		</div>
		<div class="col-md-6">
			<div class="input-group">
				@php 
				if(isset($invoice)) { $default = $invoice['due_date']; } else { $default = ''; } 
				@endphp
				{{ Form::text('due_date', $default, ['class'=> 'with-button']) }}
				<div class="input-group-append">
					<span class="fake-button btn btn-outline-primary show-calendar text-button">[ ]</span>
				</div>
			</div>
		</div>
	</div>

	<div class="form-row">
		<div class="col-md-6">
			
			{{ Form::label('amount', 'Amount') }}
		</div>
		<div class="col-md-6">
			{{ Form::text('amount') }}
		</div>
	</div>

	<div class="form-row">
		<div class="col-md-6">
			
			{{ Form::label('description', 'Description') }}
		</div>
		<div class="col-md-6">
			{{ Form::text('description') }}
		</div>
	</div>
	
	<hr style="height: 1px; width: 100%;">
	<div class="form-row">
		<div class="col-md-12">
			
			{{ Form::submit('Submit') }}
		</div>

	</div>
