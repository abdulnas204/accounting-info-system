<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AllTablesAddUserColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function(Blueprint $table) {
            $table->integer('user_id')->unsigned();
        });
        Schema::table('taxes', function(Blueprint $table) {
            $table->integer('user_id')->unsigned();
        });
        Schema::table('bills', function(Blueprint $table) {
            $table->integer('user_id')->unsigned();
        });
        Schema::table('inventory', function(Blueprint $table) {
            $table->integer('user_id')->unsigned();
        });
        Schema::table('vendors', function(Blueprint $table) {
            $table->integer('user_id')->unsigned();
        });
        Schema::table('invoices', function(Blueprint $table) {
            $table->integer('user_id')->unsigned();
        });
        Schema::table('transactions', function(Blueprint $table) {
            $table->integer('user_id')->unsigned();
        });
        Schema::table('balance_sheet_accounts', function(Blueprint $table) {
            $table->integer('user_id')->unsigned();
        });
        Schema::table('sales', function(Blueprint $table) {
            $table->integer('user_id')->unsigned();
        });
        Schema::table('purchases', function(Blueprint $table) {
            $table->integer('user_id')->unsigned();
        });
        Schema::table('inventory_items', function(Blueprint $table) {
            $table->integer('user_id')->unsigned();
        });
        Schema::table('transactions_data', function(Blueprint $table) {
            $table->integer('user_id')->unsigned();
        });
        Schema::table('invoice_data', function(Blueprint $table) {
            $table->integer('user_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('customers', function(Blueprint $table) {
            $table->dropColumn('user_id');
        });
        Schema::table('taxes', function(Blueprint $table) {
            $table->dropColumn('user_id');
        });
        Schema::table('bills', function(Blueprint $table) {
            $table->dropColumn('user_id');
        });
        Schema::table('inventory', function(Blueprint $table) {
            $table->dropColumn('user_id');
        });
        Schema::table('vendors', function(Blueprint $table) {
            $table->dropColumn('user_id');
        });
        Schema::table('invoices', function(Blueprint $table) {
            $table->dropColumn('user_id');
        });
        Schema::table('transactions', function(Blueprint $table) {
            $table->dropColumn('user_id');
        });
        Schema::table('balance_sheet_accounts', function(Blueprint $table) {
            $table->dropColumn('user_id');
        });
        Schema::table('sales', function(Blueprint $table) {
            $table->dropColumn('user_id');
        });
        Schema::table('purchases', function(Blueprint $table) {
            $table->dropColumn('user_id');
        });
        Schema::table('inventory_items', function(Blueprint $table) {
            $table->dropColumn('user_id');
        });
        Schema::table('transactions_data', function(Blueprint $table) {
            $table->dropColumn('user_id');
        });
        Schema::table('invoice_data', function(Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
