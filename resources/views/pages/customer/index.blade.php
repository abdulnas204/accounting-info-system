@extends('main')
@section('stylesheet')
	<link rel="stylesheet" type="text/css" href="/css/customer.css">
@stop
@section('title')
	Manage Customers
@stop

@section('content')
<div id="customer-view-container">
	
	@if(\Session::has('feedback'))
		<p>{{ Session::get('feedback') }}</p>
	@endif
	<div class="row">
		<div class="col-md-6">
			<h2>Add a Customer</h2>
	
			{{ Form::open(['route' => 'customer.store', 'id'=>'customer-builder-form']) }}
				@include('pages.customer.form')
			{{ Form::close() }}
		</div>

		<div class="col-md-6">
			<h2>Customers</h2>
			<div id='customer-list' >
				
			@foreach($customers as $customer)
				<div class="dropdown">
					<button class="btn btn-sm btn-outline-info dropdown-toggle customer-info-bar" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						&nbsp&nbsp{{ $customer['id'] }} <br>
						{{ $customer['name'] }} | {{ $customer['company'] }} <br>
						{{ $customer['address'] }} | {{ $customer['state'] }} {{ $customer['zip'] }} <br>
						{{ $customer['email'] }} | {{ $customer['phone_number'] }} <br>
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<div class="row">
							<div class="col-md-12">
								<a class='dropdown-item' href="/customer/{{$customer['id']}}">
									{{-- <button>View Details</button> --}}
									View Details
								</a>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								
								<a class='dropdown-item' href="/customer/{{$customer['id']}}/edit">
									{{-- <button>Edit</button> --}}
									Edit
								</a>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
		    					<button style="cursor:pointer;"class="dropdown-item" onclick="if(confirm('Are you sure?')){$(this).find('form').submit()};">Delete
									<form action="{{ url('/customer/' . $customer['id']) }}" method="post">
		        						{{ method_field("DELETE") }}
		        						{{-- {{ csrf_field() }} --}}
		    						</form>
		    					</button>
							</div>
						</div>
					</div>
				</div>
			@endforeach
			</div>
		</div>
		
	</div>
</div>

@stop

@section('scripts')
	<script src='js/customer.js'></script>
@stop