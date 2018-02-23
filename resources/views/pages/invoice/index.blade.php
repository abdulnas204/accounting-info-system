@extends('main')
@section('stylesheet')
	<link rel="stylesheet" href="css/invoice.css">
@stop
@section('title')
	Manage Invoices
@stop

@section('content')
	@if(\Session::has('feedback'))
		<p>{{ \Session::get('feedback') }}</p>
	@endif

	<div class="row">
		<div class="col-md-6">
			<h2>Add Invoice</h2>
			{{ Form::open(['route' => 'invoice.store', 'id'=>'invoice-builder-form']) }}
				@include('pages.invoice.form')
							<hr>
			
			
				<div class="row">
					{{-- <input type="text" name='loltest' id='loltest'> --}}
						<div class="col-md-12">
					<table id="line-item-list">
							<thead>
								<tr>
									<th style="text-align: center">Item Name</th>
									<th style="text-align: center">Price</th>
									<th style="text-align: center">Quantity</th>
									<th style="text-align: center">Unit</th>
									<th style="text-align: right">Total</th>
								</tr>
							</thead>
						{{-- </div> --}}
			
			
						{{-- <div class="col-md-12"> --}}
						<tbody>
					<span id="add-new-item" class="fake-button fake-button-a" >Add New</span>
							<tr>
								<td><input type="text" class="item-line" name='invoice-line-item-name[]'></td>
								<td><input type="text" class="price-line" name='invoice-line-item-price[]'></td>
								<td><input type="text" class="quantity-line" name='invoice-line-item-quantity[]'></td>
								<td><input type="text" class="unit-line" name='invoice-line-item-unit[]'></td>
								<td><span id='invoice-line-item-total'></span></td>
							</tr>
						</tbody>
						<tfoot>
							<tr style="height: 50px">
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td id="subtotal-label"><strong>Subtotal</strong></td>
								<td id="subtotal-number"></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td id="tax-label"><strong>Taxes</strong></td>
								<td id="tax-number"></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td id="shipping-label"><strong>Shipping</strong></td>
								<td id="shipping-number"></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td id="total-label"><strong>Total</strong></td>
								<td id="total-number"></td>
							</tr>
						</tfoot>
					</table>
			
					{{-- <table id="line-item-totals">
						<thead>
							
						</thead>
						<tbody style="width: 100%; display: inline-block; align-items: flex-end; 			flex-direction:column">
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
				</div>
				<div class="form-row">
					<div class="col-md-12">
						
						{{ Form::submit('Submit') }}
					</div>
			
				</div>
			{{ Form::close() }}
		</div>
		<div class="col-md-6" style="height: 350px">
			<h2>Information</h2>
			<div class="form-feedback">
				
			</div>
		</div>
	</div>
	<br>
	<hr>
	<br>

	<div class="row">
		
		<div class="col-md-12">
			<h2>Invoice List</h2>
			<table id="invoice-list">
				<tr>
					<th>Manage</th>
					<th>Invoice ID</th>
					<th>Name</th>
					<th>Company</th>
					<th>Email</th>
					<th>Address</th>
					<th>Date Issued</th>
					<th>Date Due</th>
					<th>Amount</th>
					<th>Description</th>
					<th>Order ID</th>
					<th>Paid?</th>
				</tr>

				{{ $invoices->links('partials._pagination') }}
				@foreach($invoices as $invoice)
				<tr>
					<td>
						<a href="/invoice/{{$invoice['invoice_id']}}">
							<button>Details</button>
						</a>
						<a href="/invoice/{{$invoice['invoice_id']}}/edit">
							<button class="">Edit{{-- <span class="glyphicon glyphicon-pencil"></span> --}}</button>
						</a> <br>
						<button onclick="if(confirm('Are you sure?')){$(this).find('form').submit()};" href="">
							@if(!$invoice['paid'])
							Mark Paid
							@else
							Mark Unpaid
							@endif
							<form action="{{ url('/invoice/' . $invoice['invoice_id'] . '/paid') }}" method="post">
        						{{ csrf_field() }}
    						</form>
						</button>
						<button class="" onclick="if(confirm('Are you sure?')){$(this).find('form').submit()};" href="">Delete
							<form action="{{ route('invoice.destroy', $invoice['invoice_id']) }}" method="post">
        						{{-- <input type="hidden" name="_method" value="DELETE"> --}}
        						{{ method_field("DELETE") }}
        						{{ csrf_field() }}
    						</form>
    					</button>
						{{-- </div> --}}
    				</td>
					<td>{{ $invoice['invoice_id'] }}</td>	
					<td>{{ $invoice['name'] }}</td>
					<td>{{ $invoice['company'] }}</td>
					<td>{{ $invoice['email'] }}</td>
					<td>{{ $invoice['address'] }}</td>
					<td>{{ $invoice['created_at'] }}</td>
					<td>{{ $invoice['due_date'] }}</td>
					<td>${{ $invoice['amount'] }}</td>
					<td>{{ $invoice['description'] }}</td>
					<td>{{ $invoice['order_id'] }}</td>	
					<td>@if($invoice['paid'])Yes @else No @endif</td>	
				</tr>
				@endforeach
			</table>
			<ul>

			
			</ul>
		</div>
	</div>

@stop

@section('scripts')
	<script src="/js/modules/customer-preview.js"></script>
	<script src="/js/invoice.js"></script>
@stop