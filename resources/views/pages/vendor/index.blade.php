@extends('main')
@section('stylesheet')
	{{-- <link rel="stylesheet" type="text/css" href="/css/vendor.css"> --}}
	<link rel="stylesheet" href="css/vendor.css">
@stop
@section('title')
	<h1>Manage Vendors</h1>
@stop

@section('content')
<div class="vendor-view-container">
	
</div>
	@if(\Session::has('feedback'))
		<p>{{ Session::get('feedback') }}</p>
	@endif
	<div class="row">
		<div class="col-md-6">
			<h2>Add a Vendor</h2>
			{{ Form::open(['route' => 'vendor.store', 'onsubmit' => 'return formValidator()']) }}
				@include('pages.vendor.form')
			{{ Form::close() }}
		</div>

		<div class="col-md-6" style=''>
			<div class="row">
				<div class="col-md-6">
					<h2>Vendors</h2>
				</div>
				<div class="col-md-6" style="margin-top: 5px; ">
					<div class="input-group">
						<input type="text" class="with-button" id="search-vendors" placeholder='Search vendors' style='float: right;width: 95%'>
						<div class="input-group-append">
							<span class="btn-raw btn btn-outline-primary text-button clear-search-field">X</span>
						</div>
					</div>
				</div>
			</div>
			<div id='vendor-list' >
				
			@foreach($vendors as $vendor)
				<div class="dropdown">
					<button class="btn btn-sm btn-outline-info dropdown-toggle vendor-info-bar" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						&nbsp&nbsp{{ $vendor['vendor_id'] }} <br>
						{{ $vendor['name'] }} | {{ $vendor['company'] }} <br>
						{{ $vendor['address'] }} | {{ $vendor['state'] }} {{ $vendor['zip'] }} <br>
						{{ $vendor['email'] }} | {{ $vendor['phone_number'] }} <br>
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<div class="row">
							<div class="col-md-12">
								<a class='dropdown-item' href="/vendor/{{$vendor['vendor_id']}}">
									{{-- <button>View Details</button> --}}
									View Details
								</a>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								
								<a class='dropdown-item' href="/vendor/{{$vendor['vendor_id']}}/edit">
									{{-- <button>Edit</button> --}}
									Edit
								</a>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
		    					<button style="cursor:pointer;"class="dropdown-item" onclick="if(confirm('Are you sure?')){$(this).find('form').submit()};">Delete
									<form action="{{ url('/vendor/' . $vendor['vendor_id']) }}" method="post">
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
	<div class="row">
		
		
	</div>

@stop

@section('scripts')
	<script src="js/vendor.js"></script>
@stop