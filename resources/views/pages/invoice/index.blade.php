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
			{{ Form::close() }}
		</div>
		<div class="col-md-6" style="height: 350px">
			<h2>Information</h2>
			<div class="form-feedback">
				
			</div>
		</div>
	</div>

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