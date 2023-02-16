<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('product_wishlist');
        Schema::dropIfExists('discount_product');
        Schema::create('productables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')
            ->constrained()
            ->onDelete('cascade');
            $table->morphs('productable');
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
        Schema::dropIfExists('productables');
        Schema::create('product_wishlist', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wishlist_id')
            ->onDelete('cascade')
            ->constrained();
            $table->foreignId('product_id')
            ->onDelete('cascade')
            ->constrained();
            $table->timestamps();
        });
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
}
