<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoreablesTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('categoreables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
            ->constrained()
            ->onDelete('cascade');
            $table->morphs('categoreable');
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
        Schema::dropIfExists('categoreables');
    }
}
