	
	<div class="form-row">
		<div class="col-md-6">
			
			{{ Form::label('name', 'Customer Name') }}
		</div>
		<div class="col-md-6">
			{{ Form::text('name') }}
		</div>
	</div>

	<div class="form-row">
		<div class="col-md-6">
			
			{{ Form::label('date', 'Date') }}
		</div>
		<div class="col-md-6">
			<div class="input-group">
				@php 
				if(isset($invoice)) { $default = $invoice['date']; } else { $default = ''; } 
				@endphp
				{{ Form::text('date', $default, ['class'=> 'with-button']) }}
				<div class="input-group-append">
					<span class="fake-button btn btn-outline-primary show-calendar text-button">[ ]</span>
				</div>
			</div>
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
	
	@if(!isset($tax_id))
    	@php $tax_id = 'Please choose a tax option'; @endphp
	@endif

	<div class="form-row">
		<div class="col-md-6">
			{{ Form::label('tax_id') }}
		</div>
		<div class="col-md-6">
			{{Form::select('tax_id', $tax_ids, $tax_id, ['style' => 'width: 100%;']) }}
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
			
			{{ Form::label('description', 'Description') }}
		</div>
		<div class="col-md-6">
			{{ Form::text('description') }}
		</div>
	</div>

	<div class="form-row">
		<div class="col-md-6">
			
			{{ Form::label('shipping', 'Shipping') }}
		</div>
		<div class="col-md-6">
			{{ Form::text('shipping') }}
		</div>
	</div>
	
	
