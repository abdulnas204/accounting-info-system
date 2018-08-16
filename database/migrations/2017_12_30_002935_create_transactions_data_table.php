<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions_data', function (Blueprint $table) {
            $table->increments('entry_id');
            $table->string('date');
            $table->string('transaction');
            $table->string('account_name');
            //$table->float('account_carrying_balance');
            $table->float('transaction_amount');
            $table->string('transaction_type');
            $table->string('account_normal_balance');
            $table->string('account_type');
            $table->integer('tx_id')->unsigned();
            $table->timestamps();

            $table->foreign("account_name")->references('account_name')->on('balance_sheet_accounts')->onDelete('cascade');
            
            $table->foreign("tx_id")->references('transaction_id')->on('transactions')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions_data');
        //Schema::dropIfExists('Balance_Sheet_Table');
    }
}
