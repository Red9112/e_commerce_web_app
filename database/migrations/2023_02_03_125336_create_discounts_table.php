<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{

    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->foreignId('discount_type_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->double('value');
            $table->text('description')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('expired')->default(false);
            $table->timestamps();
        });

    }


    public function down()
    {
        Schema::dropIfExists('discounts');
    }
}
