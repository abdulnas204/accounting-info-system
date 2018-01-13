<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralLedgerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('General_Ledger_Table', function (Blueprint $table) {
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

            $table->foreign("account_name")->references('account_name')->on('Balance_Sheet_Table')->onDelete('cascade');
            $table->foreign("tx_id")->references('id')->on('Transaction_List_Table');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('General_Ledger_Table');
        //Schema::dropIfExists('Balance_Sheet_Table');
    }
}
