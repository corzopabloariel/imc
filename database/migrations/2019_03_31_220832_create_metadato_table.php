<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetadatoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metadatos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('seccion',20)->nullable()->default(NULL);
            $table->text('meta')->nullable()->default(NULL);
            $table->text('descripcion')->nullable()->default(NULL);
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
        Schema::dropIfExists('metadatos');
    }
}
