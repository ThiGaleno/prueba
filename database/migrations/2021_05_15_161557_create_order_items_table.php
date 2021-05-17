<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('products_id');
            $table->foreignId('order_id');
            $table->foreign('products_id')->references('id')->on('products');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->integer('amount');
            $table->decimal('unit_price', 10,2);
            $table->decimal('discount_product', 10,2);
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
        Schema::dropIfExists('order_items');
    }
}
