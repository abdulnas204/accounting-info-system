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
    // TODO: Move these functions to BalanceSheetController
    public function addAccount(Request $request)
    {
        $data = $request->all();
        //$data = $this->data->all();
        $acc_name = $data['payload'][0];
        $account_type = $data["payload"][1];
        $account_type = ucfirst($account_type);
        
        $this->addAcc($acc_name, $account_type);
    
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

    /**
     * Adds a new entry to the general ledger
     *
     * @param $date
     *
     * @param $desc
     *
     * @param $acc_name
     *
     * @param $tx_amnt
     *
     * @param $tx_type
     *
     * @param $repeat
     */
    public function addNewEntry($date, $desc, $acc_name, $tx_amnt, $tx_type, $more_args)
    {
        $tx_id = 0;
        // if($repeat) {
        if(isset($more_args['repeat']) && $more_args['repeat'] === True) {
            if(Transaction::orderBy('transaction_id', 'DESC')->first()){
                $last_entry = Transaction::orderBy('transaction_id', 'DESC')->first();
                $tx_id = $last_entry->transaction_id;
            }
            else{
                $tx_id = 1;
            }
        }
        else {
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
        $tx->user_id = \Auth::user()->id;
        $tx->tx_id = $tx_id;
        $tx->save();

        $account = BalanceSheetAccount::where('account_name', '=', $tx->account_name)->first();
        $this->updateBalance($account, $tx);
    }


    /**
     * Function called by the spreadsheet to update accounts
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
                $general_ledger->user_id = \Auth::user()->id;
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
    /**
     *
     */
    public function flushNominalAccounts()
    {
        $this->closeRevenueAccounts();
        $this->closeExpenseAccounts();

        $income_summary_record = BalanceSheetAccount::where('account_name', 'Income Summary')->first()->toArray();
        $amount = $income_summary_record['balance'];

        if ($amount > 0) {
            $entry_to_earnings = 'Credit';
            $entry_to_income_summary = 'Debit';
            $description = 'Closing nominal accounts...';
        }

        else {
            $entry_to_earnings = 'Debit';
            $entry_to_income_summary = 'Credit';
            $description = 'Closing nominal accounts...';
        }
        $today = date("m-d-Y H:i:sa");
        $more_args['repeat'] = False;
        $this->addNewEntry($today, $description, 'Retained Earnings', $amount, $entry_to_earnings, $more_args);
        
        $more_args['repeat'] = True;
        $this->addNewEntry($today, $description, 'Income Summary', $amount, $entry_to_income_summary, $more_args);
    }
    
    private function closeRevenueAccounts()
    {
        try {

            $revenue_accounts = BalanceSheetAccount::where('account_type', 'Revenue')->get()->toArray();

            $revenue_summary = 0;
            $more_args = [
                'repeat' => False,
            ];
            foreach($revenue_accounts as $rev){
                $revenue_summary += $rev['balance'];
            }
            foreach($revenue_accounts as $revenue){
                if($revenue['account_name'] === 'Income Summary') {
                    continue;
                }

                $this->addNewEntry(date("m-d-Y H:i:sa"), 'Closing Revenue Account', $revenue['account_name'], $revenue['balance'], 'Debit', $more_args);
                $more_args['repeat'] = True;
            }
            $this->addNewEntry(date("m-d-Y H:i:sa"), 'Closing Revenue Account', 'Income Summary', $revenue_summary, 'Credit', $more_args);
            $message = "Successfully closed revenue accounts";
            $code = 200;
        }
        catch (Exception $e) {
            $message = $e->getMessage();
            $code = 503;
        }

    }

    private function closeExpenseAccounts()
    {

        $expense_accounts = BalanceSheetAccount::where('account_type', 'Expense')->get()->toArray();

        $expense_summary = 0;
        $more_args = [
            'repeat' => False,
        ];
        foreach($expense_accounts as $exp){
            $expense_summary += $exp['balance'];
        }

        $this->addNewEntry(date("m-d-Y H:i:sa"), 'Closing Expense Account', 'Income Summary', $expense_summary, 'Debit', $more_args);
        $more_args['repeat'] = True;

        foreach($expense_accounts as $expense){
            $this->addNewEntry(date("m-d-Y H:i:sa"), 'Closing Expense Account', $expense['account_name'], $expense['balance'], 'Credit', $more_args);
        }

    }
    private function addNewTransaction($description, $invoice=null)
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
        $tx_list->invoice_id = $invoice ?? null;
        $tx_list->user_id = \Auth::user()->id;
        
        $tx_list->save();
        
        return $last_entry_num;
    }

    private function addAcc($acc_name, $acc_type)
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
        $acoount->user_id = \Auth::user()->id;
        $account->save();
    }

    /**
     * Updates the balance of an account
     *
     * @param BalanceSheetAccount $account
     *   The BalanceSheetAccount being affected
     *
     * @param TransactionData $tx_data
     *   The TransactionData object
     */
    private function updateBalance(BalanceSheetAccount $account, TransactionData $tx_data)
    {
        $normal_balance = $account->account_normal_balance;

         if ($tx_data->transaction_type === $normal_balance) {
             $account->balance = (float)$account->balance + (float)$tx_data->transaction_amount;
         }
         else {
             $account->balance = (float)$account->balance - (float)$tx_data->transaction_amount;
         }
        $account->save();
        //Session::flash("message", 'Worked');
        return 1;
    }
}
