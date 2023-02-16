<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->onDelete('cascade')->constrained();
            $table->foreignId('payment_id')->onDelete('cascade')->constrained();
            $table->foreignId('address_id')->onDelete('cascade')->constrained();
            $table->foreignId('shipping_id')->onDelete('cascade')->constrained();
            $table->foreignId('order_status_id')->onDelete('cascade')->constrained();
            $table->double('order_total');
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
        Schema::dropIfExists('orders');
    }
}
