@extends('main')
@section('stylesheet')
	<link rel="stylesheet" href="css/style.css">
@endsection

@section('title')
@endsection

@section('content')
	<meta class="csrf-token" name="csrf-token" content="{{ csrf_token() }}">
	
	<div id="ledger-container">
		<div class="ledger-header">
		<h1>Viewing the Ledger</h1>
			{{$accounts->links()}}

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
			@foreach ($accounts as $account)
<div class="tx-row"><span class="cell number-cell">{{-- {{$i}} --}}</span><input type="text" class="cell date-cell" value="{{ $account['date'] }}" disabled><input type="text" class="cell transaction-cell" value="{{ $account['account_name'] }}" disabled><input type="text" class="cell debit-cell" value="@if($account['transaction_type']==='Debit'){{$account['transaction_amount']}}@endif" disabled><input type="text" class="cell credit-cell" value="@if($account['transaction_type']==='Credit'){{$account['transaction_amount']}}@endif" disabled><input type="text" class="cell desc-cell" value="{{$account['transaction']}}" disabled></div>@endforeach{{-- //////

/////// --}}<hr><hr><hr><div class="tx-row"><span class="cell number-cell"></span><input type="text" class="cell date-cell"><input type="text" class="cell transaction-cell"><input type="text" class="cell debit-cell"><input type="text" class="cell credit-cell"><input type="text" class="cell desc-cell"></div><div class="tx-row"><span class="cell number-cell"></span><input type="text" class="cell date-cell"><input type="text" class="cell transaction-cell"><input type="text" class="cell debit-cell"><input type="text" class="cell credit-cell"><input type="text" class="cell desc-cell"></div></div>{{-- ledger-body --}}

		<div class="ledger-bar">
			<button class="create-new-tx">New Transaction</button>
			<button class="create-new-row">New Row</button>
			<button class="create-new-desc">New Description</button>
			
		</div>

	</div>{{-- ledger-container --}}

		
	<div id="menu-container">
		<div class="menu-header">
			<h2>Menu</h2>
			<hr>			
		</div>
		<div class="menu-body">
			<button class="btn-view-accounts">View Accounts</button><br>
			<button class="none">Transaction Scheduler</button><br>
			<button class="none">Anotha One</button><br>
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