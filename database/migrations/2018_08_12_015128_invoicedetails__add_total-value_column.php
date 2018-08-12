<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InvoicedetailsAddTotalValueColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('InvoiceDetails', function(Blueprint $table) {
            $table->float('total_value')->after('price');
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
        Schema::table('InvoiceDetails', function(Blueprint $table) {
            $table->dropColumn('total_value');
        });
    }
}
