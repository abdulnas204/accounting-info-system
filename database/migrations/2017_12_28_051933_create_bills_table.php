<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('bill_id');
            $table->string('name');
            $table->integer('customer_id')->unsigned();
            $table->string('company');
            $table->string('email');
            $table->string('address');
            $table->integer('order_id')->nullable()->unsigned();
            $table->string('due_date');
            $table->float('amount');
            $table->string('description')->nullable();
            $table->timestamps();

            $table->foreign('customer_id')->references('customer_id')->on("customers")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
}
