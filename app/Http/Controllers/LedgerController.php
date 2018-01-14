<?php

namespace App\Http\Controllers;
//namespace App;

use Illuminate\Http\Request;
use App\Balance_Sheet_Accounts;
use App\General_Ledger_Transactions;
use App\Transaction_List;
use Carbon\Carbon;

class LedgerController extends Controller
{
	public function __construct()
	{
		//$this->$data = $request;
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
		//$data = $this->data->all();
		$account_type = $data["payload"][1];
		$account_type = ucfirst($account_type);


		/*if($account_type === "Asset" || 
			$account_type === "Contraequity" ||
			$account_type === "Expense")
		{
			$account->account_normal_balance = "Debit";
			print_r("Account named '" . $data["payload"][0] . "' saved as $account_type");
		}
		elseif($account_type === "Liability" || 
			$account_type === "Equity" || 
			$account_type === "Contraasset" ||
			$account_type === "Revenue")
		{
			$account->account_normal_balance = "Credit";
			print_r("Account named '" . $data["payload"][0] . "' saved as $account_type");
		}
		else{
			$account->account_normal_balance = "null";
			print_r("No normal balance entered!");
		}*/
		
		$this->addAcc($data['payload'][0], $account_type);

    }
    protected function addAcc($acc_name, $acc_type)
    {
    	$account = new Balance_Sheet_Accounts;

    	if($acc_type === "Asset" || 
			$acc_type === "Contraequity" ||
			$acc_type === "Expense")
		{
			$account->account_normal_balance = "Debit";
			print_r("Account named '" . $acc_name . "' saved as $acc_type");
		}
		elseif($acc_type === "Liability" || 
			$acc_type === "Equity" || 
			$acc_type === "Contraasset" ||
			$acc_type === "Revenue")
		{
			$account->account_normal_balance = "Credit";
			print_r("Account named '" . $acc_name . "' saved as $acc_type");
		}
		else{
			$account->account_normal_balance = "null";
			print_r("No normal balance entered!");
		}

    	$account->account_name = $acc_name;
    	$account->balance = 0.00;
    	$account->account_type = $acc_type;
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
    protected function addNewTransaction()
    {
    	if(Transaction_List::orderBy('id', 'DESC')->first()){
			$last_entry = Transaction_List::orderBy('id', 'DESC')->first();
			$last_entry_num = $last_entry->id + 1;
		}
		else{
			$last_entry_num = 1;
		}
		$tx_list = new Transaction_List;

		$tx_list->id = $last_entry_num;
		$tx_list->description = 'coming soon';
		$tx_list->date = 'coming soon';
		$tx_list->number_of_transactions = 1;
		$tx_list->transaction_ids = 'coming soon';
		$tx_list->save();

		return $last_entry_num;
    }
    protected function updateAccountBalance($sum, $type, $tx)
    {
    	$affected_account = Balance_Sheet_Accounts::find($tx);
		$affected_account_balance = $affected_account->balance;
		$affected_account_type = $affected_account->account_normal_balance;
		
		$sum = (float)$sum;
		
		if($type === 'Debit'){
		    if($affected_account_type === "Debit"){
		    	$new_balance = $affected_account_balance + $sum;
		    }
		    else{
		    	$new_balance = $affected_account_balance - $sum;
		    }
		}
		else{
		    if($affected_account_type === "Debit"){
		    	$new_balance = $affected_account_balance - $sum;
		    }
		    else{
		    	$new_balance = $affected_account_balance + $sum;
		    }
		}
		$affected_account->balance = $new_balance;
		$affected_account->save();

		print_r("Updated account '" . $tx . "'!  New balance = " . $new_balance . "\n");
    }
    public function updateAccount(Request $request)
    {	
		$data = $request->all();
		$data = (array)$data;
		
		$account_list = Balance_Sheet_Accounts::all();

		$list = [];
		foreach($account_list as $acc){
			array_push($list, $acc->account_name);
		}
		$last_num = $this->addNewTransaction();
		// Apply process to each row of the ledger, entire TX is passed into this encapsulating method
		foreach($data as $row){
			// This makes sure that the account exists - it throws a fatal error 	otherwise and breaks the request
			if(in_array($row['tx'], $list)){
				
			   	if($row['dr']){
			   		$this->updateAccountBalance($row['dr'], 'Debit', $row['tx']);
			   	}
			   	else{
					$this->updateAccountBalance($row['cr'], 'Credit', $row['tx']);
			   	}

				$general_ledger = new General_Ledger_Transactions;
				$general_ledger->date = $row['date'];
				//$general_ledger->transaction = $row['desc'] ? $row['desc'] : $row['tx'];
				$general_ledger->transaction = $row['desc'];
				$general_ledger->account_name = $row['tx'];
				$general_ledger->transaction_amount = $row['dr'] ? $row['dr'] : $row['cr'];
				$general_ledger->transaction_type = $row['dr'] ? 'Debit' : 'Credit';
				// THIS NEEDS TO SOMEHOW KNOW THE NORMAL BALANCE...
				$general_ledger->account_normal_balance = 'test';
				$general_ledger->account_type = 'DEL ME!';
				$general_ledger->tx_id = $last_num;
				$general_ledger->save();
	
			}
			// Check if a tx cell is empty
			elseif($row['tx'] === null){
				print_r("No account entered!\n");
			}
			else{
				print_r("Error: '" . $row["tx"] . "' does not exist!\n");
			}

		}
    }
    public function flushNominalAccounts()
    {
        $revenue_accounts = Balance_Sheet_Accounts::where('account_type', 'Revenue')->get()->toArray();
        $expense_accounts = Balance_Sheet_Accounts::where('account_type', 'Expense')->get()->toArray();

        $revenue_summary = 0;
        $expense_summary = 0;

        foreach($revenue_accounts as $rev){
        	$revenue_summary += $rev['balance'];
        }
        foreach($expense_accounts as $exp){
        	$expense_summary += $exp['balance'];
        }
        //$this->addAcc('Income Summary', 'Equity');
        $close_rev_tx = $this->addNewTransaction();

        $this->addJournalEntry(date('m/d/Y'), 'Income Summary', 'Income Summary', $revenue_summary, 'Credit', 'Credit', 'Nominal', $close_rev_tx);
        $this->updateAccountBalance($revenue_summary, 'Credit', 'Income Summary');
        foreach($revenue_accounts as $revenue){
        	$this->addJournalEntry(date('m/d/Y'), 'Closing Revenue Account', $revenue['account_name'], $revenue['balance'], 'Debit', 'Credit', 'Nominal', $close_rev_tx);
        	$this->updateAccountBalance($revenue['balance'], 'Debit', $revenue['account_name']);
        }
        $close_exp_tx = $this->addNewTransaction();

    	$this->addJournalEntry(date('m/d/Y'), 'Income Summary', 'Income Summary', $expense_summary, 'Debit', 'Credit', 'Nominal', $close_exp_tx);
    	$this->updateAccountBalance($expense_summary, 'Debit', 'Income Summary');
        foreach($expense_accounts as $expense){
        	$this->addJournalEntry(date('m/d/Y'), 'Closing Expense Account', $expense['account_name'], $expense['balance'], 'Credit', 'Debit', 'Nominal', $close_exp_tx);
        	$this->updateAccountBalance($expense['balance'], 'Credit', $expense['account_name']);
        }



    }
    protected function addJournalEntry($date, $desc, $acc_name, $tx_amnt, $tx_type, $acc_norm, $acc_type, $tx_id)
    {
    	$tx = new General_Ledger_Transactions;
		$tx->date = $date;
		$tx->transaction = $desc;
		$tx->account_name = $acc_name;
		$tx->transaction_amount = $tx_amnt;
		$tx->transaction_type = $tx_type;
		$tx->account_normal_balance = $acc_norm;
		$tx->account_type = $acc_type;
		$tx->tx_id = $tx_id;
		//return $tx;
		$tx->save();
    }

    public function test(){
    	//$accounts = new General_Ledger_Transactions;
        /*$accounts = General_Ledger_Transactions::paginate(100)->toArray();
        $accts = General_Ledger_Transactions::paginate(100);
        foreach($accts as $acc){
        	print_r($acc);
        }
        $tx = Transaction_List::all()->toArray();
        //print_r($accounts->toArray());
        $newArr = [];
        $increment = 0;

        //var_dump($accounts['data'][0]);
        foreach($tx as $line){
        	$line_num = $line['id'];
	        $newArr[$line_num] = [];

	        foreach($accounts['data'] as $account){
	        	//print_r($account['date']);
	        	$temp_num = $account['tx_id'];
	        	if($account['tx_id'] === $line_num){
	        		array_push($newArr[$account['tx_id']], $account);
	        	}

	        }
        }
        //print_r($newArr);
        foreach($newArr as $key => $value){
        	echo $key . "|||||";
        	print_r($value);
        	echo "<br>\n";
        }*/
        //print_r($newArr);
        ///////////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////////////////////////////////////////////////////////
        //$transactions = Transaction_List::transaction()->paginate(100);
     


     /*   $transactions = Transaction_List::all()->toArray();
        $temp = [];
        foreach($transactions as $tx){
        	$temp[$tx['id']] = Transaction_List::find($tx['id'])->transaction->toArray();
        }
        print_r($temp);*/




        //$transactions = Transaction_List::find(1)->transaction;
    	//return view('pages.ledger')->with('accounts', $accounts);
        //return view('pages.ledger')->with('accounts', $transactions);




        /////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////////
        /*$peanut = 'peanut';
        $collection = collect([
        	'a'		=> function() use ($peanut){return $peanut;},
        	'b'		=> 'watermelon',
        	'c' 	=> 'oranges',
        	'd' 	=> 'grapefruit'
        ]);

        print_r($collection);*/

        

        /*foreach($collection as $k=>$c){
        	print_r("-=$k=-" . $c);
        }*/

    }

}
