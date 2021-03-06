<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InvoicedetailsAddTaxidColumn extends Migration
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
            $table->integer('tax_id')->unsigned()->after('price');
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
            $table->dropColumn('tax_id');
        });
    }
}
