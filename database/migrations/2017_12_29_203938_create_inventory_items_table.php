<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('InventoryItems', function (Blueprint $table) {
            $table->increments('item_id');
            $table->string('name');
            $table->string('date');
            $table->double('units');
            $table->string('unit_type');
            $table->float('cost_basis');
            $table->integer('vendor_id')->unsigned();
            $table->integer('inventory_id')->unsigned();
            $table->tinyInteger('paid')->default(0);
            $table->string('due_date');
            $table->float('order_value');
            $table->timestamps();

            $table->foreign('inventory_id')->references('inventory_id')->on('Inventory');
            $table->foreign('vendor_id')->references('vendor_id')->on('Vendors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('InventoryItems');
    }
}
