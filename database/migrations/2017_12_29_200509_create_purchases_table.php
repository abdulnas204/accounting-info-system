<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('purchase_id');
            $table->string('date');
            $table->integer("vendor_id")->unsigned()->nullable();
            $table->string('description');
            $table->float('amount');
            $table->integer('bill_id')->unsigned()->nullable();
            $table->string('due_date')->nullable();
            $table->tinyInteger('paid')->default(0);
            $table->string('notes')->nullable();

            $table->timestamps();

            $table->foreign('vendor_id')->references('vendor_id')->on('vendors');
            // $table->foreign('bill_id')->references('id')->on('Bills');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}
