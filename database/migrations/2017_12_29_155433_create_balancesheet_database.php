<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBalancesheetDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BalanceSheetAccounts', function (Blueprint $table) {
            //$table->increments('id');
            $table->string('account_name')->unique();
            $table->float('balance');
            $table->string('account_normal_balance');
            $table->string('account_type');
            $table->timestamps();

            $table->primary("account_name");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('GeneralLedgerTransactions');
        Schema::dropIfExists('BalanceSheetAccounts');
    }
}
