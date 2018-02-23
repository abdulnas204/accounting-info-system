<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('InvoiceDetails', function (Blueprint $table) {
            $table->increments('invoice_detail_id');
            $table->string('item');
            $table->integer('quantity');
            $table->float('price');
            $table->integer('invoice_id')->unsigned();
            $table->integer("inventory_id")->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('InvoiceDetails');
    }
}
