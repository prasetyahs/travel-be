<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Travel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("description");
            $table->double("price");
            $table->string("city");
            $table->string("lat");
            $table->string("lon");
            $table->unsignedBigInteger('category');
            $table->foreign('category')->references('id')->on('category');
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
        Schema::dropIfExists('travel');
    }
}
