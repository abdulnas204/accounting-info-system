@extends('main')

@section('title')
	<h1>Open Accounting Information System</h1>

@endsection

@section('content')
	<div class="row">
		<div class="col-md-8">
			<p>Welcome to OAIS.  This software is designed to help manage your business's finances, interact with customers, update books, and more.  This software is designed to be easy and straightfoward while also offering many benefits to seasoned bookkeepers such as direct access to the general ledger (with Excel like functionality).  This software is constantly being updated so please bear with the changes, it is still in its infancy and many things are due to change.  Thanks for trying out OAIS and if you'd like to contribute, feel free to submit a pull request on Github.</p>
			<p>This system is designed to be practical and intuitive.  Begin by setting up basic company details, tax information, and other general information.  Then simply begin as you would think you should: record incomes and expenses as they occur and begin adding new customers or vendors.</p>
			<img src="/img/accounting-cycle.jpg" alt="Accounting Cycle Image" style="margin-left: 50px">
			<br><br>
			<p>Throughout the business cycle, record new transactions and expenses.  A business generates money, no?  Create invoices and send them to clients/customers.  Businesses also happen to cost money to run--record your expenses as they occur.  Journal entries are automatically inserted behind-the-scenes and help to create well-separated accounts which can be used for analysis and effective bookkeeping.</p>
			<p>If you so wish to view the ledger, you can!  For more experienced accountants and bookkeepers, you have direct access to the general ledger which can give you more flexibility when creating new transactions.  There are also many helpful features on the ledger that can automate many tasks such as closing entries.</p>
			<p>End of the period and need documents?  OAIS can generate documents based on all the information you supplied it throughout the period.  OAIS handles all the heavy and boring work for you by compiling together the information into various financial statements and documents at the blink of an eye.  Flush the nominal accounts using the Ledger and all revenues and expenses and other nominal accounts should be closed, dropped into their appropriate bucket, and reports can be generated.  Then the cycle repeats.</p>
			<p>Thanks for using OAIS and if you have any feedback, please e-mail it to calvinchoe1@gmail.com or submit an 'Issue' at Github.  Best of luck.</p>
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

