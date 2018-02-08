<?php

use Illuminate\Database\Seeder;

class BalanceSheetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Assets
        DB::table('Balance_Sheet_Table')->insert([
        	'account_name'		=> 'Cash',
        	'balance'			=> 0,
        	'account_normal_balance'	=> 'Debit',
        	'account_type'		=> 'Asset'
        ]);
        DB::table('Balance_Sheet_Table')->insert([
        	'account_name'		=> 'Inventory',
        	'balance'			=> 0,
        	'account_normal_balance'	=> 'Debit',
        	'account_type'		=> 'Asset'
        ]);
        DB::table('Balance_Sheet_Table')->insert([
        	'account_name'		=> 'Accounts Receivable',
        	'balance'			=> 0,
        	'account_normal_balance'	=> 'Debit',
        	'account_type'		=> 'Asset'
        ]);

        //Liabilities
        DB::table('Balance_Sheet_Table')->insert([
        	'account_name'		=> 'Accounts Payable',
        	'balance'			=> 0,
        	'account_normal_balance'	=> 'Credit',
        	'account_type'		=> 'Liability'
        ]);

        //Equity
        DB::table('Balance_Sheet_Table')->insert([
        	'account_name'		=> 'Retained Earnings',
        	'balance'			=> 0,
        	'account_normal_balance'	=> 'Credit',
        	'account_type'		=> 'Equity'
        ]);
        DB::table('Balance_Sheet_Table')->insert([
        	'account_name'		=> 'Owner\'s Equity',
        	'balance'			=> 0,
        	'account_normal_balance'	=> 'Credit',
        	'account_type'		=> 'Equity'
        ]);

        // Revenues
        DB::table('Balance_Sheet_Table')->insert([
        	'account_name'		=> 'Income Summary',
        	'balance'			=> 0,
        	'account_normal_balance'	=> 'Credit',
        	'account_type'		=> 'Revenue'
        ]);
        DB::table('Balance_Sheet_Table')->insert([
        	'account_name'		=> 'Revenues',
        	'balance'			=> 0,
        	'account_normal_balance'	=> 'Credit',
        	'account_type'		=> 'Revenue'
        ]);

        //Expense
        DB::table('Balance_Sheet_Table')->insert([
        	'account_name'		=> 'Expenses',
        	'balance'			=> 0,
        	'account_normal_balance'	=> 'Debit',
        	'account_type'		=> 'Expense'
        ]);
        
    }
}
