@extends('main')

@section('title')
	<h1>Open Accounting Information System</h1>

@endsection

@section('content')
	<div class="row">
		<div class="col-md-8">
			<h2>Introduction</h2>
			<br>
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
	<br>
	<div class="row">
		<div class="col-md-8">
			<h2>Getting Started</h2>
			<br>
			<p>OAIS is designed to allow for multiple use cases.  Whether you're a service or sales based business, OAIS can help you manage your finances and your records.</p>
			<p>Begin by installing the basic necessities through the install script (COMING SOON).  This will set up basic databases, install Laravel dependencies, create the basic database schema, and more behind-the-scenes work.  This sets the foundation for your software to work with.</p>
			<p>Then you need to add some information about the business.  Navigate to Settings and begin entering in relevant information such as preferences for inventory, tax options, etc.  Some settings are optional and some are recommended but default values exist for most entries (which can be found in its corresponding location).</p>
			<p>Unfortunately, OAIS is not a mind reader.  While it simplifies the process of managing information, it cannot tell what transactions are what--you must supply relevant information.  The following outlines this process: </p>
			<p>For all transactions, there is a given ledger account that corresponds to it.  The finer details are managed for you but you must first start by creating the necessary accounts.  For example, revenues are automatically created for you but if you would like more specific information to be collected, you can also create new Revenue accounts that more closely align to your business' activities.  Otherwise, all revenues will be entered as a general "Revenue".</p>
			<ol>
				<li>Create a new account - most important accounts such as cash and retained earnings are handled for you but you can be more specific</li>
				<li>New accounts are created for you and the interface will act as a buffer between you and the underlying database, ensuring consistent entries to the database.</li>
				<li>When entering new transactions, take care to specify which account is being affected.  You don't need any special knowledge to do this--if you generate revenue from providing a service, simply pick the account you created for that specific Revenue stream.  If you are a lawn care business, an appropriate Revenue account might be named Lawn Care Revenue and all revenues associated with that activity should be assigned to that account.  Same for expenses.</li>
				<li>As your business generates revenues and expenses, they will be recorded and maintained in the database.  Special views and actions can be accomplished through the user interface provided.</li>
				<li>When financial statements must be generated, the click of a button can do it all for you.  This will empty out Revenue and expense accounts (and other nominal accounts), calculate income, compile into statements, complete many other helpful functions that would otherwise take many man-hours to complete.</li>
				<li>No stops necessary!  Closing nominal accounts should have 0 delays on your record keeping.  Begin right away as you normally would and the system will pick up where it left off.</li>
				<li>For more information on the basic principles of accrual accounting, please visit the section on Accrual Account (coming soon).</li>
			</ol>
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

