@extends('main')
@section('stylesheet')
	<link rel="stylesheet" href="css/style.css">
@endsection

@section('title')
	<h1>Viewing the Ledger</h1>
@endsection

@section('content')
	<div class="page-container">
		<div id="ledger-container">
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
					</div>
				@endfor
			</div>{{-- ledger-body --}}
			<button class="create-new-tx">New Row</button>
	
		</div>{{-- ledger-container --}}
		
	</div>
	<div class="menu-container">
		<div class="menu-header">
			<h2>Menu</h2>
			<hr>			
		</div>
		<div class="menu-body">
			<a href="/">Back to Main</a>
		</div>
		<br><br><br><br><br><br><br>
		<br><br><br><br><br><br><br>
		<br><br><br><br><br><br><br>
		<hr>
		{{-- On btn click, generate query for db --}}
		<button class="btn-save-changes">Save Changes</button>
		<button class="btn-clear-changes">Clear Changes</button>
	</div>

@endsection

@section('scripts')
	<script src="js/ledger-scripts.js"></script>
@endsection