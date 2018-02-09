@extends('main')
@section('stylesheet')
	<link rel="stylesheet" href="css/bill.css">
@stop
@section('title')
	Manage Bills
@stop

@section('content')
	@if(\Session::has('feedback'))
		<p>{{ \Session::get('feedback') }}</p>
	@endif

	<div class="row">
		<div class="col-md-6">
			<h2>Add Bill</h2>
			{{ Form::open(['route' => 'bill.store', 'id'=>'bill-builder-form']) }}
				@include('pages.bill.form')
			{{ Form::close() }}
		</div>
		<div class="col-md-6">
			<h2>Information</h2>
			<div class="form-feedback">
				
			</div>
		</div>
	</div>
	<div class="row">
		
		<div class="col-md-12">
			<h2>bill List</h2>
			<table id="bill-list">
				<tr>
					<th>Manage</th>
					<th>bill ID</th>
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

				{{ $bills->links('partials._pagination') }}
				@foreach($bills as $bill)
				<tr>
					<td>
						<a href="/bill/{{$bill['bill_id']}}">
							<button>Details</button>
						</a>
						<a href="/bill/{{$bill['bill_id']}}/edit">
							<button class="">Edit{{-- <span class="glyphicon glyphicon-pencil"></span> --}}</button>
						</a> <br>
						<button onclick="if(confirm('Are you sure?')){$(this).find('form').submit()};" href="">
							@if(!$bill['paid'])
							Mark Paid
							@else
							Mark Unpaid
							@endif
							<form action="{{ url('/bill/' . $bill['bill_id'] . '/paid') }}" method="post">
        						{{ csrf_field() }}
    						</form>
						</button>
						<button class="" onclick="if(confirm('Are you sure?')){$(this).find('form').submit()};" href="">Delete
							<form action="{{ route('bill.destroy', $bill['bill_id']) }}" method="post">
        						{{-- <input type="hidden" name="_method" value="DELETE"> --}}
        						{{ method_field("DELETE") }}
        						{{ csrf_field() }}
    						</form>
    					</button>
						{{-- </div> --}}
    				</td>
					<td>{{ $bill['bill_id'] }}</td>	
					<td>{{ $bill['name'] }}</td>
					<td>{{ $bill['company'] }}</td>
					<td>{{ $bill['email'] }}</td>
					<td>{{ $bill['address'] }}</td>
					<td>{{ $bill['created_at'] }}</td>
					<td>{{ $bill['due_date'] }}</td>
					<td>${{ $bill['amount'] }}</td>
					<td>{{ $bill['description'] }}</td>
					<td>{{ $bill['order_id'] }}</td>	
					<td>@if($bill['paid'])Yes @else No @endif</td>	
				</tr>
				@endforeach
			</table>
			<ul>

			
			</ul>
		</div>
	</div>

@stop

@section('scripts')
	<script src="js/bill.js"></script>
@stop