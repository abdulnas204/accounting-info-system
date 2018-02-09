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
			
			{{ Form::label('vendor_name', 'Vendor Name') }}
		</div>
		<div class="col-md-6">
			{{ Form::text('vendor_name') }}
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
			
			{{ Form::label('amount', 'Amount') }}
		</div>
		<div class="col-md-6">
			{{ Form::text('amount') }}
		</div>
	</div>
	
	<div class="form-row">
		<div class="col-md-6">
			
			{{ Form::label('bill_id', 'Bill ID') }}
		</div>
		<div class="col-md-6">
			{{ Form::text('bill_id') }}
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
			
			{{ Form::label('notes', 'Notes') }}
		</div>
		<div class="col-md-6">
			{{ Form::text('notes') }}
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


	{{ Form::hidden('vendor_id', '', ['id'=> 'vendor_id']) }}

	<hr>
	<div class="form-row">
		<div class="col-md-12">
			
			{{ Form::submit('Submit') }}
		</div>

	</div>
