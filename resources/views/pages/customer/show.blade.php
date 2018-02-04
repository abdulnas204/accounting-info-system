@extends('main')

@section('stylesheet')
	<link rel="stylesheet" type="text/css" href="/css/customer.css">
@stop
@section('title')
	Viewing Customer
@endsection

@section('content')
<div id="customer-view-container" >
	<a href="{{ route('customer.index') }}"><<<< Back to Customers</a>

	<div class="container col-md-8">
		
		<div class="row">
			<div class="col-md-6">
				<h2>{{ $customer['name'] }}</h2>
			</div>
			<div class="col-md-6" style="display:flex; justify-content: flex-end; margin-top: 5px">
				<a href="/customer/{{$customer['id']}}/edit">
					Edit
				</a>
				&nbsp|&nbsp
				<a class="" onclick="if(confirm('Are you sure?')){$(this).find('form').submit()};" href="">Delete
					<form action="{{ url('/customer/' . $customer['id']) }}" method="post">
		        		{{ method_field("DELETE") }}
		        		{{ csrf_field() }}
		    		</form>
		    	</a>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8">
				{{ $customer['address'] }}  <br>
				{{ $customer['city'] }}, {{ $customer['state'] }} {{ $customer['zip'] }} {{ $customer['country'] }} <br>
				{{ $customer['phone_number'] }}	| {{ $customer['email'] }}<br>
				
			</div>
			<div class="col-md-4">
				Notes: <br>
				{{ $customer['notes'] }}
			</div>
		</div>
		<hr>
			<div class="row">
				<div class="col-md-12">
					<table>
						<tr>
							<th>Invoice ID</th>
							<th>Due Date</th>
							<th>Description</th>
							<th>Amount</th>
							<th>Invoice Created</th>
							<th>Order ID</th>
						</tr>
						@foreach($customer['invoice'] as $invoice)
						<tr>
							<td>{{ $invoice['id'] }}</td>
							<td>{{ $invoice['due_date'] }}</td>
							<td>{{ $invoice['description'] }}</td>
							<td>{{ $invoice['amount'] }}</td>
							<td>{{ $invoice['created_at'] }}</td>
							<td>{{ $invoice['order_id'] }}</td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>

	</div>

</div>

@endsection