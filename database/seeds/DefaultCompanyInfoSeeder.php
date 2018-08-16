<?php

use Illuminate\Database\Seeder;

class DefaultCompanyInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Assets
        DB::table('general_info')->insert([
            'company_name'      => 'default company',
            'owner_name'        => 'owner,'
        ]);
        

        //Expense
        /*DB::table('BalanceSheetAccounts')->insert([
        	'account_name'		=> 'Expenses',
        	'balance'			=> 0,
        	'account_normal_balance'	=> 'Debit',
        	'account_type'		=> 'Expense'
        ]);*/
        
    }
}
