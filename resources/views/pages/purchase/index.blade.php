@extends('main')
@section('stylesheet')
	<link rel="stylesheet" href="css/purchase.css">
@stop
@section('title')
	Manage Purchases
@stop

@section('content')
	@if(\Session::has('feedback'))
		<p>{{ \Session::get('feedback') }}</p>
	@endif

	<div class="row">
		<div class="col-md-6">
			<h2>Add Purchase</h2>
			{{ Form::open(['route' => 'purchase.store', 'id'=>'purchase-builder-form', 'onsubmit'=> 'return formValidator()']) }}
				@include('pages.purchase.form')
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
			<h2>Purchase List</h2>
			<table id="purchase-list">
				<tr>
					<th>Manage</th>
					<th>Purchase ID</th>
					<th>Date Purchased</th>
					<th>Vendor</th>
					<th>Description</th>
					<th>Amount</th>
					<th>Bill ID</th>
					<th>Date Due</th>
					<th>Paid?</th>
					<th>Notes</th>
				</tr>

				@foreach($purchases as $purchase)
				<tr>
					<td>
						<a href="/purchase/{{$purchase['purchase_id']}}">
							<button>Details</button>
						</a>
						<a href="/purchase/{{$purchase['purchase_id']}}/edit">
							<button class="">Edit{{-- <span class="glyphicon glyphicon-pencil"></span> --}}</button>
						</a> <br>
						<button onclick="if(confirm('Are you sure?')){$(this).find('form').submit()};" href="">
							@if(!$purchase['paid'])
							Mark Paid
							@else
							Mark Unpaid
							@endif
							<form action="{{ url('/purchase/' . $purchase['purchase_id'] . '/paid') }}" method="post">
        						{{ csrf_field() }}
    						</form>
						</button>
						<button class="" onclick="if(confirm('Are you sure?')){$(this).find('form').submit()};" href="">Delete
							<form action="{{ route('purchase.destroy', $purchase['purchase_id']) }}" method="post">
        						{{-- <input type="hidden" name="_method" value="DELETE"> --}}
        						{{ method_field("DELETE") }}
        						{{ csrf_field() }}
    						</form>
    					</button>
						{{-- </div> --}}
    				</td>
					<td>{{ $purchase['purchase_id'] }}</td>	
					<td>{{ $purchase['date'] }}</td>
					<td> Vendor </td>
					{{-- <td>{{ $purchase['company'] }}</td> --}}
					{{-- <td>{{ $purchase['email'] }}</td>
					<td>{{ $purchase['address'] }}</td> --}}
					{{-- <td>{{ $purchase['created_at'] }}</td> --}}
					<td>{{ $purchase['description'] }}</td>
					<td>${{ $purchase['amount'] }}</td>
					<td> Bill date </td>
					<td>{{ $purchase['due_date'] }}</td>
					{{-- <td>{{ $purchase['order_id'] }}</td>	 --}}
					<td>@if($purchase['paid'])Yes @else No @endif</td>	
					<td>{{ $purchase['notes'] }}</td>
				</tr>
				@endforeach
			</table>
			<ul>

			
			</ul>
		</div>
	</div>

@stop

@section('scripts')
	<script src="/js/modules/vendor-preview.js"></script>
	<script src="/js/purchase.js"></script>
@stop