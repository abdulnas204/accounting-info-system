@extends('main')

@section('title')
	<h1>Select An Option</h1>

@endsection

@section('content')
	<ol class="main-menu">

		{{-- Main interface for ledger - this will essentially be a spreadsheet--}}
		<li class="menu-item"><a href="/ledger">View the Ledger</a></li>

		{{-- Compose the current ledger into financial statements --}}
		<li class="menu-item"><a href="/compose">Compose Financial Statements</a></li>
		
		{{-- This is for administrative actions regarding the DB (aka the ledger) --}}
		<li class="menu-item"><a href="/admin">Administrative Actions</a></li>
	</ol>

@endsection

