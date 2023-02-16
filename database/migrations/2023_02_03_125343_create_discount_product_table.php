<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountProductTable extends Migration
{

    public function up()
    {
        Schema::create('discount_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('discount_id')
            ->onDelete('cascade')
            ->constrained();
            $table->foreignId('product_id')
            ->onDelete('cascade')
            ->constrained();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('discount_product');
    }
}
