<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleDespachosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_despachos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('idDespacho')->unsigned();
            $table->foreign('idDespacho')->references('id')->on('despachos');
            $table->bigInteger('idProducto')->unsigned();
            $table->foreign('idProducto')->references('id')->on('productos');
            $table->integer('cantidad');
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
        Schema::dropIfExists('detalle_despachos');
    }
}
