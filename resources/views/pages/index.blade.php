@extends('main')

@section('title')
	<h1>Open Accounting Information System</h1>

@endsection

@section('content')
	<div class="row">
		<div class="col-md-12">
			
			<p>Welcome to OAIS.  This software is designed to help manage your business's finances, interact with customers, update books, and more.  This software is designed to be easy and straightfoward while also offering many benefits to seasoned bookkeepers such as direct access to the general ledger (with Excel like functionality).  This software is constantly being updated so please bear with the changes, it is still in its infancy and many things are due to change.  Thanks for trying out OAIS and if you'd like to contribute, feel free to submit a pull request on Github.</p>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6">
			
			<!-- <ol class="main-menu">
					
				{{-- Main interface for ledger - this will essentially be a spreadsheet--}}
				<li class="menu-item"><a href="/ledger">View the Ledger</a></li>
					
				{{-- CRUD section for Customer Entry --}}
				<li class="menu-item"><a href="/customers">Add/Edit Customers</a></li>
					
				{{-- Compose the current ledger into financial statements --}}
				<li class="menu-item"><a href="/compose">Compose Financial Statements</a></li>
				
				{{-- This is for administrative actions regarding the DB (aka the ledger) --}}
				<li class="menu-item"><a href="/admin">Administrative Actions</a></li>
			</ol> -->
		</div>
	</div>

@endsection

