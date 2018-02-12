	
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
	
	<hr>


	<div class="form-row">
		{{-- <input type="text" name='loltest' id='loltest'> --}}
			<div class="col-md-12">
		<table id="line-item-list">
				<thead>
					<tr>
						<th>Item Name</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Unit</th>
						<th>Total</th>
					</tr>
				</thead>
			{{-- </div> --}}


			{{-- <div class="col-md-12"> --}}
			<tbody>
				<tr>
					<td><input type="text" name='invoice-line-item-name[]'></td>
					<td><input type="text" class="price-line" name='invoice-line-item-price[]'></td>
					<td><input type="text" class="quantity-line" name='invoice-line-item-quantity[]'></td>
					<td><input type="text" name='invoice-line-item-unit[]'></td>
					<td><span id='invoice-line-item-total'></span></td>
				</tr>
			</tbody>
			<tfoot>
				<tr></tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td id="subtotal-label">Subtotal</td>
					<td id="subtotal-number"></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td id="tax-label">Taxes</td>
					<td id="tax-number"></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td id="total-label">Total</td>
					<td id="total-number"></td>
				</tr>
			</tfoot>
		</table>

		{{-- <table id="line-item-totals">
			<thead>
				
			</thead>
			<tbody style="width: 100%; display: inline-block; align-items: flex-end; flex-direction:column">
				<tr>
					<th>Subtotal</th>
					<td>Ahh</td>
				</tr>
				<tr>
					<th>Taxes</th>
					<td>123</td>
				</tr>
				<tr>
					<th>Total</th>
					<td>1234</td>
				</tr>
			</tbody>
		</table> --}}
		</div>
		<span id="add-new-item" class="fake-button fake-button-a" style="float:right">Add New</span>
	</div>
	<div class="form-row">
		<div class="col-md-12">
			
			{{ Form::submit('Submit') }}
		</div>

	</div>
