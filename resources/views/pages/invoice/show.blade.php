@extends('main')

@section('stylesheet')
	<link rel="stylesheet" type="text/css" href="/css/invoice.css">
@stop
@section('title')
	Viewing Invoice

@endsection

@section('content')
	{{-- {{env('APP_URL')}} --}}
<div class="row">
	<div class="col-md-4">
		
		<a href="{{ route('invoice.index') }}"><<<< Back to Invoices</a>
	</div>
	<div class="col-md-8" style="display:flex; justify-content: flex-end; margin-top: 5px">
		<a href="/invoice/{{$invoice['invoice_id']}}/print" class="fake-button">Print</a>
		&nbsp|&nbsp
		<a class="fake-button" href="/invoice/{{$invoice['invoice_id']}}/edit">
			Edit
		</a>
		&nbsp|&nbsp
		<span class="fake-button-a fake-button" onclick="if(confirm('Are you sure?')){$(this).find('form').submit()};">Delete
			<form action="{{ url('/invoice/' . $invoice['invoice_id']) }}" method="post">
	     		{{ method_field("DELETE") }}
	     		{{ csrf_field() }}
	 		</form>
	 	</span>
		&nbsp|&nbsp
		<span class="fake-button-a fake-button" onclick="if(confirm('Are you sure?')){$(this).find('form').submit()};">
			@if(!$invoice['paid'])
			Mark Paid
			@else
			Mark Unpaid
			@endif
			<form action="{{ url('/invoice/' . $invoice['invoice_id'] . '/paid') }}" method="post">
   			{{ csrf_field() }}
   		</form>
		</span>
	</div>
</div>
<div id="invoice-view-container" >
	@if(\Session::has('feedback'))
		<p>{{ \Session::get('feedback') }}</p>
	@endif
	@include('pages.invoice.templates.ddefault-1')
	{{-- <iframe src="{{env('APP_URL')}}/invoice/{{$invoice['invoice_id']}}/print" frameborder="0"></iframe> --}}
	{{-- <div class="container col-md-8">
		
		<div class="row">
			<div class="col-md-6">
				<h2>{{ $invoice['name'] }}</h2>
			</div>
			<div class="col-md-6" style="display:flex; justify-content: flex-end; margin-top: 5px">
				<a href="/invoice/{{$invoice['invoice_id']}}/print" class="fake-button">Print</a>
				&nbsp|&nbsp
				<a class="fake-button" href="/invoice/{{$invoice['invoice_id']}}/edit">
					Edit
				</a>
				&nbsp|&nbsp
				<span class="fake-button-a fake-button" onclick="if(confirm('Are you sure?')){$(this).find('form').submit()};">Delete
					<form action="{{ url('/invoice/' . $invoice['invoice_id']) }}" method="post">
		        		{{ method_field("DELETE") }}
		        		{{ csrf_field() }}
		    		</form>
		    	</span>
				&nbsp|&nbsp
				<span class="fake-button-a fake-button" onclick="if(confirm('Are you sure?')){$(this).find('form').submit()};">
					@if(!$invoice['paid'])
					Mark Paid
					@else
					Mark Unpaid
					@endif
					<form action="{{ url('/invoice/' . $invoice['invoice_id'] . '/paid') }}" method="post">
        				{{ csrf_field() }}
    				</form>
				</span>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<table>
					<thead>
						<tr>
							<th>Invoice ID</th>
							<th>Due Date</th>
							<th>Description</th>
							<th>Amount</th>
							<th>Invoice Created</th>
							<th>Order ID</th>
							<th>Paid?</th>
						</tr>
					</thead>
					<tbody>
						

					<tr>
						<td>{{ $invoice['invoice_id'] }}</td>
						<td>{{ $invoice['due_date'] }}</td>
						<td>{{ $invoice['description'] }}</td>
						<td>Remove me</td>
						<td>{{ $invoice['created_at'] }}</td>
						<td>{{ $invoice['order_id'] }}</td>
						<td>@if($invoice['paid'])Yes @else No @endif</td>
					</tr>

					</tbody>
					
				</table>
				<hr>


				
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<table id="line-item-list">
					<thead>
						<tr>
							<th>Item</th>
							<th>Price</th>
							<th>Quantity</th>
							<th>Units</th>
							<th>Total Value</th>
						</tr>
					</thead>
					<tbody>
						@foreach($invoice_details as $detail)
						<tr>
							<td>{{ $detail['item'] }}</td>
							<td>$ {{ $detail['total_value']}}</td>
							<td>{{ $detail['quantity'] }}</td>
							<td>{{ $detail['unit'] }}</td>
							<td>${{ $detail['total_value'] }}</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr></tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td id="subtotal-label">Subtotal</td>
							<td id="subtotal-number">${{ $invoice['amount'] - $invoice['taxes'] }}</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td id="tax-label">Taxes</td>
							<td id="tax-number">${{ $invoice['taxes'] }}</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td id="total-label">Total</td>
							<td id="total-number">${{ $invoice['amount'] }}</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>

	</div> --}}

</div>

@endsection