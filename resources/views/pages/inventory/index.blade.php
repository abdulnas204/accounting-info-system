@extends('main')
@section('stylesheet')
	<link rel="stylesheet" href="css/inventory.css">
@stop
@section('title')
	Manage inventorys
@stop

@section('content')
	@if(\Session::has('feedback'))
		<p>{{ \Session::get('feedback') }}</p>
	@endif

	<div class="row">
		<div class="col-md-6">
			<h2>Add inventory</h2>
			{{ Form::open(['route' => 'inventory.store', 'id'=>'inventory-builder-form']) }}
				@include('pages.inventory.form')
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
			<h2>inventory List</h2>
			<table id="inventory-list">
				<tr>
					<th>Manage</th>
					<th>inventory ID</th>
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

				{{-- {{ $inventorys->links('partials._pagination') }} --}}
				{{-- @foreach($inventorys as $inventory)
				<tr>
					<td>
						<a href="/inventory/{{$inventory['inventory_id']}}">
							<button>Details</button>
						</a>
						<a href="/inventory/{{$inventory['inventory_id']}}/edit">
							<button class="">Edit</button>
						</a> <br>
						<button onclick="if(confirm('Are you sure?')){$(this).find('form').submit()};" href="">
							@if(!$inventory['paid'])
							Mark Paid
							@else
							Mark Unpaid
							@endif 
							<form action="{{ url('/inventory/' . $inventory['inventory_id'] . '/paid') }}" method="post">
        						{{ csrf_field() }}
    						</form>
						</button>
						<button class="" onclick="if(confirm('Are you sure?')){$(this).find('form').submit()};" href="">Delete
							<form action="{{ route('inventory.destroy', $inventory['inventory_id']) }}" method="post">
        						
        						{{ method_field("DELETE") }}
        						{{ csrf_field() }}
    						</form>
    					</button>

    				</td>
					<td>{{ $inventory['inventory_id'] }}</td>	
					<td>{{ $inventory['name'] }}</td>
					<td>{{ $inventory['company'] }}</td>
					<td>{{ $inventory['email'] }}</td>
					<td>{{ $inventory['address'] }}</td>
					<td>{{ $inventory['created_at'] }}</td>
					<td>{{ $inventory['due_date'] }}</td>
					<td>${{ $inventory['amount'] }}</td>
					<td>{{ $inventory['description'] }}</td>
					<td>{{ $inventory['order_id'] }}</td>	
					<td>@if($inventory['paid'])Yes @else No @endif</td>	
				</tr>
				@endforeach --}}
			</table>
			<ul>

			
			</ul>
		</div>
	</div>

@stop

@section('scripts')
	<script src='/js/modules/inventory-preview.js'></script>
	<script src="/js/modules/vendor-preview.js"></script>
	<script src="/js/inventory.js"></script>
@stop