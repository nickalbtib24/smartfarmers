<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogosProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogos_producto', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('catalogo_id');
            $table->unsignedInteger('producto_id');
            $table->unique(['catalogo_id','producto_id']);
            $table->foreign('catalogo_id')->references('id')->on('catalogos')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
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
        Schema::dropIfExists('catalogos_producto');
    }
}
