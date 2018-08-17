<?php

namespace App\Http\Controllers;
//namespace App;

use Illuminate\Http\Request;
use App\Models\BalanceSheetAccount;
use App\Models\TransactionData;
use App\Models\Transaction;
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
        $res = new BalanceSheetAccount;
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
        
        $this->addAcc($data['payload'][0], $account_type);
    
    }
    protected function addAcc($acc_name, $acc_type)
    {
        $account = new BalanceSheetAccount;

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
        
        $account = new BalanceSheetAccount;
        
        $row = BalanceSheetAccount::where('account_name', '=', $acc_name)->delete();
        if($row){
            print_r("Successfully deleted account '" . "$acc_name" . "'");
        }
        else{
            print_r("Error, '" . $acc_name . "' does not exist.");
        }
    }
    protected function addNewTransaction($description, $invoice=null)
    {
        if (Transaction::orderBy('transaction_id', 'DESC')->first()) {
            $last_entry = Transaction::orderBy('transaction_id', 'DESC')->first();
            $last_entry_num = $last_entry->transaction_id + 1;
        }
        else{
            $last_entry_num = 1;
        }
        $tx_list = new Transaction;
        
        $tx_list->transaction_id = $last_entry_num;
        $tx_list->description = $description;
        $tx_list->date = 'coming soon';
        $tx_list->number_of_transactions = 0;
        //$tx_list->transaction_ids = 'coming soon';
        
        $tx_list->invoice_id = $invoice ? $invoice : null;
        
        $tx_list->save();
        
        return $last_entry_num;
    }

    /**
     * Adds a new entry to the general ledger
     *
     */
    public function addNewEntry($date, $desc, $acc_name, $tx_amnt, $tx_type, $more_args)
    {
        $tx_id = 0;
        // if($repeat) {
        if($more_args['repeat']) {
            if(Transaction::orderBy('transaction_id', 'DESC')->first()){
                $last_entry = Transaction::orderBy('transaction_id', 'DESC')->first();
                $tx_id = $last_entry->transaction_id;
            }
            else{
                $tx_id = 1;
            }
        }
        else{
            if(isset($more_args['invoice_id'])) {
                $invoice_id = $more_args['invoice_id'];
                $tx_id = $this->addNewTransaction($desc, $invoice_id);
            }
            else {
                $tx_id = $this->addNewTransaction($desc);
            }
        }

        $tx = new TransactionData;
        $tx->date = $date;
        $tx->transaction = $desc;
        $tx->account_name = $acc_name;
        $tx->transaction_amount = $tx_amnt;
        $tx->transaction_type = $tx_type;
        ///$tx->account_normal_balance = $acc_norm_balance;
        //$tx->account_type = $acc_type;
        $tx->tx_id = $tx_id;
        $tx->save();

        $account = BalanceSheetAccount::where('account_name', '=', $tx->account_name);
        $this->updateBalance($account, $tx);
    }

    public function updateBalance(BalanceSheetAccount $account, TransactionData $tx_data)
    {
        //$entries = TransactionData::where('tx_id', '=', $tx->transaction_id);
        $normal_balance = $account->account_normal_balance;

        //foreach ($entries as $entry) {
            if ($tx_data->transaction_type === $normal_balance) {
                $account->balance = (float)$account->balance + (float)$tx_data->transaction_amount;
            }
            else {
                $account->balance = (float)$account->balance - (float)$tx_data->transaction_amount;
            }
        //}
        $account->save();
        //Session::flash("message", 'Worked');
        return 1;
    }

    /**
     * Called from the spreadsheet
     *
     * @param Request $request
     *   The request body from a POST request
     */
    public function updateAccount(Request $request)
    {   
        $data = $request->all();
        $data = (array)$data;
        
        $account_list = BalanceSheetAccount::all();

        $list = [];
        foreach($account_list as $acc){
            array_push($list, $acc->account_name);
        }
        $last_num = $this->addNewTransaction('auto');
        // Apply process to each row of the ledger, entire TX is passed into this encapsulating method
        foreach($data as $row){
            // This makes sure that the account exists - it throws a fatal error    otherwise and breaks the request
            if(in_array($row['tx'], $list)){
                

                $general_ledger = new TransactionData;
                $general_ledger->date = $row['date'];
                //$general_ledger->transaction = $row['desc'] ? $row['desc'] : $row['tx'];
                $general_ledger->transaction = $row['desc'];
                $general_ledger->account_name = $row['tx'];
                $general_ledger->transaction_amount = $row['dr'] ?? $row['cr'];
                $general_ledger->transaction_type = $row['dr'] ? 'Debit' : 'Credit';
                $general_ledger->tx_id = $last_num;
                // TODO: Reject the save if the whole query does not pass
                $general_ledger->save();

                $affected_account = BalanceSheetAccount::where('account_name', '=', $row['tx'])->first();
                $transaction = Transaction::find($last_num)->first();
                $this->updateBalance($affected_account, $general_ledger);
    
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
        $revenue_accounts = BalanceSheetAccount::where('account_type', 'Revenue')->get()->toArray();
        $expense_accounts = BalanceSheetAccount::where('account_type', 'Expense')->get()->toArray();

        $revenue_summary = 0;
        $expense_summary = 0;

        foreach($revenue_accounts as $rev){
            $revenue_summary += $rev['balance'];
        }
        foreach($expense_accounts as $exp){
            $expense_summary += $exp['balance'];
        }


        $more_args = [
            'repeat' => False,
        ];

        foreach($revenue_accounts as $revenue){
            if($revenue['account_name'] === 'Income Summary') {
                continue;
            }

            $this->addNewEntry(date("m-d-Y H:i:sa"), 'Closing Revenue Account', $revenue['account_name'], $revenue['balance'], 'Debit', $more_args);
            $more_args['repeat'] = True;
        }
        $this->addNewEntry(date("m-d-Y H:i:sa"), 'Closing Revenue Account', 'Income Summary', $revenue_summary, 'Credit', $more_args);


        $more_args['repeat'] = False;
        $this->addNewEntry(date("m-d-Y H:i:sa"), 'Closing Expense Account', 'Income Summary', $expense_summary, 'Debit', $more_args);
        $more_args['repeat'] = True;

        foreach($expense_accounts as $expense){
            $this->addNewEntry(date("m-d-Y H:i:sa"), 'Closing Expense Account', $expense['account_name'], $expense['balance'], 'Credit', $more_args);
        }

        $income_summary_record = BalanceSheetAccount::where('account_name', 'Income Summary')->first()->toArray();
        $more_args['repeat'] = False;
        $amount = $income_summary_record['balance'];

        if ($amount > 0) {
            $entry_to_earnings = 'Credit';
            $entry_to_income_summary = 'Debit';

            $description = 'Closing nominal accounts...';
            
            $today = date("m-d-Y H:i:sa");
            
        
            $this->addNewEntry($today, $description, 'Income Summary', $amount, $entry_to_income_summary, $more_args);
            $more_args['repeat'] = True;
            $lol = $this->addNewEntry($today, $description, 'Retained Earnings', $amount, $entry_to_earnings, $more_args);
        }

        else {
            $entry_to_earnings = 'Debit';
            $entry_to_income_summary = 'Credit';

            $amount = $income_summary_record['balance'];
            $description = 'Closing nominal accounts...';
            
            $today = date("m-d-Y H:i:sa");
            $lol = $this->addNewEntry($today, $description, 'Retained Earnings', $amount, $entry_to_earnings, $more_args);
        
            $more_args['repeat'] = True;
            $this->addNewEntry($today, $description, 'Income Summary', $amount, $entry_to_income_summary, $more_args);
        }

    }
}
