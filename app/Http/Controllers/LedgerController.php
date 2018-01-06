<?php

namespace App\Http\Controllers;
//namespace App;

use Illuminate\Http\Request;
use App\Balance_Sheet_Accounts;
use App\General_Ledger_Transactions;
use Carbon\Carbon;

class LedgerController extends Controller
{
	public function __construct()
	{

	}
	// Access database, 
	public function showAccounts(Request $request)
	{
		//print_r("Hello world!");
		$res = new Balance_Sheet_Accounts;
		$results = $res->all();

		$temp = [];
		$returnSet = [];

		foreach($results as $result){ 
				array_push($returnSet, [
				"identifier" => $result->account_name,
				"payload"    => $result
		    ]);
		}

			print_r(json_encode($returnSet));

    }
    public function addAccount(Request $request)
    {
		$data = $request->all();
		$account_type = $data["payload"][1];
		$account_type = ucfirst($account_type);

		$account = new Balance_Sheet_Accounts;

		if($account_type === "Asset" || 
			$account_type === "Contraequity")
		{
			$account->account_normal_balance = "Debit";
			print_r("Account named '" . $data["payload"][0] . "' saved as $account_type");
		}
		elseif($account_type === "Liability" || 
			$account_type === "Equity" || 
			$account_type === "Contraasset")
		{
			$account->account_normal_balance = "Credit";
			print_r("Account named '" . $data["payload"][0] . "' saved as $account_type");
		}
		else{
			$account->account_normal_balance = "null";
			print_r("No normal balance entered!");
		}
		$account->account_name = $data["payload"][0];
		$account->account_type = $account_type;
		$account->balance = 0.00;
		$account->save();

    }
    public function removeAccount(Request $request)
    {
		$data = $request->all();

		$acc_name = $data["payload"];

		$account = new Balance_Sheet_Accounts;

		$row = Balance_Sheet_Accounts::where('account_name', '=', $acc_name)->delete();
		if($row){
		    print_r("Successfully deleted account '" . "$acc_name" . "'");
		}
		else{
		    print_r("Error, '" . $acc_name . "' does not exist.");
		}
    }
    public function updateAccount(Request $request)
    {
		$data = $request->all();
		$data = (array)$data;
		//print_r($data);
		$account_list = Balance_Sheet_Accounts::all();
		$accounts = (array)$account_list;
		
		$list = [];
		$balance_sheet = [];
		foreach($account_list as $acc){
			array_push($list, $acc->account_name);
		}

		// Apply process to each row of the ledger
		foreach($data as $row){
			// This makes sure that the account exists - it throws a fatal error otherwise and breaks the request
			if(in_array($row['tx'], $list)){
			    $transactionList = new General_Ledger_Transactions;
			    //$the_account = new Balance_Sheet_Accounts;
			   	
			   	//$affected_account = Balance_Sheet_Accounts::all()->where('account_name', '=', $row['tx']);
			   	$affected_account = Balance_Sheet_Accounts::find($row['tx']);
			   	$affected_account_balance = $affected_account->balance;
			   	$affected_account_type = $affected_account->account_normal_balance;


			   	//$affected_account_balance = $affected_account;
			   	print_r("Affected acc = " . $affected_account->balance);
				
				if($row['dr']){
				    $row['dr'] = (float)$row['dr'];

				    if($affected_account_type === "Debit"){
				    	$new_balance = $affected_account_balance + $row['dr'];
				    }
				    else{
				    	$new_balance = $affected_account_balance - $row['dr'];
				    }
				}
				else{
				    $row['cr'] = (float)$row['cr'];

				    if($affected_account_type === "Debit"){
				    	$new_balance = $affected_account_balance - $row['cr'];
				    }
				    else{
				    	$new_balance = $affected_account_balance + $row['cr'];
				    }
				}

			   	//$new_balance = $row['dr'] ? ($affected_account_type === "Debit" ? )

				$transactionList->date = $row['date'];
				$transactionList->transaction = $row['desc'] ? $row['desc'] : $row['tx'];
				$transactionList->account_name = $row['tx'];
				$transactionList->transaction_amount = $row['dr'] ? $row['dr'] : $row['cr'];
				$transactionList->transaction_type = $row['dr'] ? 'Debit' : 'Credit';
				// THIS NEEDS TO SOMEHOW KNOW THE NORMAL BALANCE...
				$transactionList->account_normal_balance = $row['dr'] ? 'Debit' : 'Credit';
				$transactionList->account_type = 'DEL ME!';
				$save = $transactionList->save();

				array_push($balance_sheet, [
					"date"					=> $row['date'],
					"transaction"			=> $row['desc'] ? $row['desc'] : $row['tx'],
					"account_name"			=> $row['tx'],
					"transaction_amount"	=> $row['dr'] ? $row['dr'] : $row['cr'],
					"transaction_type"		=> $row['dr'] ? 'Debit' : 'Credit',
				]);

				$affected_account->balance = $new_balance;
				$affected_account->save();

				print_r("Updated account '" . $row['tx'] . "'!  New balance = " . $new_balance . "\n");
			}
			// Check if a tx cell is empty
			elseif($row['tx'] === null){
				print_r("No account entered!\n");
			}
			else{
				print_r("Error: '" . $row["tx"] . "' does not exist!\n");
			}
		}
		//print_r($balance_sheet);
		//$this->updateBalances($balance_sheet);
		//$balanceSheet = new Balance_Sheet_Accounts;

		//$account = General_Ledger_Transactions::find("Accounts Payable")->account;
		//$account = Balance_Sheet_Accounts::find("Accounts Payable")->account;
		
		//print_r($account);

		/*$account = Balance_Sheet_Accounts::find('Accounts Payable')->account()->where('account_name',  'Accounts Payable');
		//print_r($account);
		foreach($account as $entry){
			print_r($entry->account_name);
			print_r("<br>\n<br>\n");
		}*/
		// $affected_account = 

    }
    public function updateBalances($data)
    {
    	$account = Balance_Sheet_Accounts::find('Accounts Payable')->account;
		//print_r($account);
		$i = 0;
		/*foreach($account as $entry){
			//print_r($i . "<br>");
			print_r($entr)
			$i++;
		}
*/
		foreach($account as $entry){
			print_r($entry . "<br>");
		}
    }
}
