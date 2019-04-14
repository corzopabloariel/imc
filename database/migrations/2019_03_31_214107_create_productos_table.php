<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo',100)->nullable();
            $table->mediumText('data')->nullable();
            $table->boolean('destacado')->default(false);
            $table->unsignedBigInteger('familia_id');
            $table->string('orden',3)->nullable();
            
            $table->foreign('familia_id')->references('id')->on('familias')->onDelete('cascade');
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
        Schema::dropIfExists('productos');
    }
}
