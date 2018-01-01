@extends('main')
@section('stylesheet')
	<link rel="stylesheet" href="css/style.css">
@endsection

@section('title')
@endsection

@section('content')
	<div id="ledger-container">
		<h1>Viewing the Ledger</h1>

		<div class="ledger-header">
			<div class="row">
				<span class="cell number-cell"></span>
				<span class="cell header-cell date-cell">Date</span>
				<span class="cell header-cell transaction-cell">Transaction</span>
				<span class="cell header-cell debit-cell">Debit</span>
				<span class="cell header-cell credit-cell">Credit</span>
			</div>
		</div>
		<div class="ledger-body">
			<div class="tx-row">
				<div class="row">
					<span class="cell number-cell">1. </span>
					<input type="text" class="cell date-cell"></input>
					<input type="text" class="cell transaction-cell"></input>
					<input type="text" class="cell debit-cell"></input>
					<input type="text" class="cell credit-cell"></input>
				</div>
				<div class="row">
					<span class="cell number-cell"></span>
					<input type="text" class="cell date-cell"></input>
					<input type="text" class="cell transaction-cell"></input>
					<input type="text" class="cell debit-cell"></input>
					<input type="text" class="cell credit-cell"></input>
				</div>
				<div class="row">
					<span class="cell number-cell"></span>
					<span class="cell number-cell"></span>
					<input type="text" class="desc-cell">
				</div>
			</div> {{-- tx-row --}}
	
			@for($i=2; $i<100; $i++)
				<div class="tx-row">
					<div class="row">
						<span class="cell number-cell">{{$i}}. </span>
						<input type="text" class="cell date-cell"></input>
						<input type="text" class="cell transaction-cell"></input>
						<input type="text" class="cell debit-cell"></input>
						<input type="text" class="cell credit-cell"></input>
					</div>
					<div class="row">
						<span class="cell number-cell"></span>
						<input type="text" class="cell date-cell"></input>
						<input type="text" class="cell transaction-cell"></input>
						<input type="text" class="cell debit-cell"></input>
						<input type="text" class="cell credit-cell"></input>
					</div>
					<div class="row">
						<span class="cell number-cell"></span>
						<span class="cell number-cell"></span>
						<input type="text" class="desc-cell">
					</div>
				</div>
			@endfor
		</div>{{-- ledger-body --}}
		<button class="create-new-tx">New Row</button>
	
	</div>{{-- ledger-container --}}
		
	<div id="menu-container">
		<div class="menu-header">
			<h2>Menu</h2>
			<hr>			
		</div>
		<div class="menu-body">
			<a href="/">Back to Main</a><br>
			<button class="btn-view-accounts">View Accounts</button><br>
			<button class="none">Some Other Option</button><br>
			<button class="none">Anotha One</button><br>
			<br><br><br><br>
			<hr>
			<button class="btn-save-changes">Save Changes</button>
			<button class="btn-clear-changes">Clear Changes</button>
			<hr>
		</div>

		{{-- On btn click, generate query for db --}}
		
	</div>
	<div class="popup-menu" style="display: none">
		<div id="popup-menu-container">
			<div class="popup-menu-header">
				<h2>Accounts Menu</h2>
			</div>
			<div class="popup-menu-body">
				
			</div>
			<div class="popup-menu-footer">
				{{-- <input type="submit" action="/ledger/accounts/show" class="btn-popup-save" value="Save Changes"> --}}
				<button class="btn-popup-close">Close Menu</button>
				<button class="btn-popup-refresh">Refresh</button>
			</div>
		</div>
	</div>

@endsection

@section('scripts')
	<script src="js/ledger-script.js"></script>
@endsection