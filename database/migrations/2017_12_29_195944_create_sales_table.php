<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Sales', function (Blueprint $table) {
            $table->increments('sale_id');
            $table->string('name');
            $table->string('company')->nullable();
            $table->string('email');
            $table->string('address');
            $table->string('phone_number');
            $table->string('zip');
            $table->string('country');

            // $table->integer('order_id')->nullable();
            $table->string('description');
            $table->string('due_date');
            $table->double('amount');
            $table->tinyInteger('paid')->default(0);

            $table->integer('customer_id')->unsigned()->nullable();
            $table->integer('inventory_id')->unsigned()->nullable();

            $table->timestamps();

            $table->foreign('customer_id')->references('customer_id')->on('Customers');
            $table->foreign('inventory_id')->references('inventory_id')->on('Inventory');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Sales');
    }
}
