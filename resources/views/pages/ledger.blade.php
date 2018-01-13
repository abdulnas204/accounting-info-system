@extends('main')
@section('stylesheet')
	<link rel="stylesheet" href="css/style.css">
@endsection

@section('title')
@endsection

@section('content')
	<meta class="csrf-token" name="csrf-token" content="{{ csrf_token() }}">
		<h1>Viewing the Ledger</h1>

	
	<div id="ledger-container">
		<div class="ledger-bar">
			<button class="create-new-tx">New Transaction</button>
			<button class="create-new-row">New Row</button>
			<button class="create-new-desc">New Description</button>
			
		</div>
		<div class="ledger-header">
			{{-- {{$accounts->links()}} --}}

			<div class="menu-row">
				<span class="number-cell"></span>
				<span class="header-cell date-cell">Date</span>
				<span class="header-cell transaction-cell">Transaction</span>
				<span class="header-cell debit-cell">Debit</span>
				<span class="header-cell credit-cell">Credit</span>
				<span class="header-cell desc-cell">Description (optional)</span>
			</div>
		</div>
		<div class="ledger-body">
			@foreach ($accounts as $accts)
<div class="tx">@foreach($accts as $account)@if($account == null) @continue @endif<div class="tx-row"><span class="cell number-cell">{{$account['tx_id']}}</span><input type="text" class="cell date-cell" value="{{ $account['date'] }}" disabled><input type="text" class="cell transaction-cell" value="{{ $account['account_name'] }}" disabled><input type="text" class="cell debit-cell" value="@if($account['transaction_type']==='Debit'){{$account['transaction_amount']}}@endif" disabled><input type="text" class="cell credit-cell" value="@if($account['transaction_type']==='Credit'){{$account['transaction_amount']}}@endif" disabled><input type="text" class="cell desc-cell" value="{{$account['transaction']}}" disabled></div>@endforeach</div>@endforeach</div>{{-- ledger-body --}}

		
	<div id="menu-container">
		<div class="menu-header">
			<h2>Menu</h2>
			<hr>			
		</div>
		<div class="menu-body">
			<button class="menu-body-btn btn-view-accounts">View Accounts</button><br>
			<button class="menu-body-btn ">Transaction Scheduler</button><br>
			<button class="menu-body-btn btn-flush-accounts">Flush Nominal Accounts</button><br>
			<button class="menu-body-btn ">Anotha One</button><br>
			<br><br><br><br>
			<hr>
			<button class="btn-save-changes">Save Changes</button>
			<button class="btn-clear-changes">Clear Changes</button>
			<hr>
		</div>
		<div class="menu-footer">
			
			<a href="/">Back to Main</a><br>
		</div>
	</div>{{-- menu-container --}}

		{{-- On btn click, generate query for db --}}
		
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