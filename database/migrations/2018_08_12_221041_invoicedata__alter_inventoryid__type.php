<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InvoicedataAlterInventoryidType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('invoice_data', function(Blueprint $table) {
            $table->integer('inventory_id')->unsigned()->nullable()->change()->first();
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
        Schema::table('invoice_data', function(Blueprint $table) {
            $table->integer('inventory_id')->unsigned()->change();
        });
    }
}
