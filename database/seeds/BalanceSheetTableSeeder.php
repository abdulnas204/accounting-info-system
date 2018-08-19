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
        DB::table('balance_sheet_accounts')->insert([
        	'account_name'		=> 'Cash',
        	'balance'			=> 0,
        	'account_normal_balance'	=> 'Debit',
        	'account_type'		=> 'Asset',
            'user_id'           => 1
        ]);
        DB::table('balance_sheet_accounts')->insert([
        	'account_name'		=> 'Inventory',
        	'balance'			=> 0,
        	'account_normal_balance'	=> 'Debit',
        	'account_type'		=> 'Asset',
            'user_id'           => 1
        ]);
        DB::table('balance_sheet_accounts')->insert([
        	'account_name'		=> 'Accounts Receivable',
        	'balance'			=> 0,
        	'account_normal_balance'	=> 'Debit',
        	'account_type'		=> 'Asset',
            'user_id'           => 1
        ]);

        //Liabilities
        DB::table('balance_sheet_accounts')->insert([
        	'account_name'		=> 'Accounts Payable',
        	'balance'			=> 0,
        	'account_normal_balance'	=> 'Credit',
        	'account_type'		=> 'Liability',
            'user_id'           => 1
        ]);

        //Equity
        DB::table('balance_sheet_accounts')->insert([
        	'account_name'		=> 'Retained Earnings',
        	'balance'			=> 0,
        	'account_normal_balance'	=> 'Credit',
        	'account_type'		=> 'Equity',
            'user_id'           => 1,

        ]);
        DB::table('balance_sheet_accounts')->insert([
        	'account_name'		=> 'Owner\'s Equity',
        	'balance'			=> 0,
        	'account_normal_balance'	=> 'Credit',
        	'account_type'		=> 'Equity',
            'user_id'           => 1,

        ]);

        // Revenues
        DB::table('balance_sheet_accounts')->insert([
        	'account_name'		=> 'Income Summary',
        	'balance'			=> 0,
        	'account_normal_balance'	=> 'Credit',
        	'account_type'		=> 'Revenue',
            'user_id'           => 1,

        ]);
        DB::table('balance_sheet_accounts')->insert([
        	'account_name'		=> 'Revenues',
        	'balance'			=> 0,
        	'account_normal_balance'	=> 'Credit',
            'account_type'		=> 'Revenue',
            'user_id'           => 1,

        ]);

        //Expense
        DB::table('balance_sheet_accounts')->insert([
        	'account_name'		=> 'Expenses',
        	'balance'			=> 0,
        	'account_normal_balance'	=> 'Debit',
            'account_type'		=> 'Expense',
            'user_id'           => 1,
        ]);
        
    }
}
