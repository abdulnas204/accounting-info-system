	
	<div class="form-row">
		<div class="col-md-6">
			
			{{ Form::label('inventory_name', 'Inventory Name') }}
		</div>
		<div class="col-md-6">
			{{ Form::text('inventory_name') }}
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
			
			{{ Form::label('vendor_name', 'Vendor Name') }}
		</div>
		<div class="col-md-6">
			{{ Form::text('vendor_name') }}
		</div>
	</div>
	
{{-- 	<div class="form-row">
		<div class="col-md-6">
			
			{{ Form::label('order_id', 'Order ID') }}
		</div>
		<div class="col-md-6">
			{{ Form::text('order_id') }}
		</div>
	</div> --}}
	<div class="form-row">
		<div class="col-md-6">
			
			{{ Form::label('date', 'Date') }}
		</div>
		<div class="col-md-6">
			<div class="input-group">
				@php 
				if(isset($inventory)) { $default = $inventory['date']; } else { $default = ''; } 
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
			
			{{ Form::label('units_purchased', 'Units Purchased') }}
		</div>
		<div class="col-md-6">
			{{ Form::text('units_purchased') }}
		</div>
	</div>

	<div class="form-row">
		<div class="col-md-6">
			
			{{ Form::label('units_type', 'Units Type') }}
		</div>
		<div class="col-md-6">
			{{ Form::text('units_type') }}
		</div>
	</div>

	<div class="form-row">
		<div class="col-md-6">
			
			{{ Form::label('price_point', 'Price Point') }}
		</div>
		<div class="col-md-6">
			{{ Form::text('price_point') }}
		</div>
	</div>
	
	<div class="form-row">
		<div class="col-md-6">
			
			{{ Form::label('due_date', 'Payment Due Date') }}
		</div>
		<div class="col-md-6">
			<div class="input-group">
				@php 
				if(isset($inventory)) { $default = $inventory['due_date']; } else { $default = ''; } 
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
			
			{{ Form::label('paid', 'Paid?') }}
		</div>
		<div class="col-md-6">
			{{ Form::checkbox('paid', 1, false) }}
		</div>
	</div>

	<hr>
	{{ Form::hidden('vendor_id', '', ['id'=> 'vendor_id']) }}
	{{ Form::hidden('inventory_id', '', ['id'=> 'inventory_id']) }}
	<div class="form-row">
		<div class="col-md-12">
			
			{{ Form::submit('Submit') }}
		</div>

	</div>
