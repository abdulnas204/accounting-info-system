<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Customer;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Invoices', function (Blueprint $table) {
            $table->increments('invoice_id');
            $table->string('name');
            $table->string('company')->nullable();
            $table->double('amount');
            $table->string('due_date');
            $table->string('email');
            $table->string('address');
            $table->integer('customer_id')->unsigned();
            $table->integer('order_id')->nullable();
            $table->tinyInteger('paid')->default(0);
            $table->string('description');
            $table->timestamps();

            $table->foreign("customer_id")->references('customer_id')->on('Customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Invoices');
    }
}
