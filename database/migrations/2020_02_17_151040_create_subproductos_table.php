<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubproductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subproductos', function (Blueprint $table) {
            $table->bigInteger('idProducto')->unsigned();
            $table->foreign('idProducto')->references('id')->on('productos');
            $table->bigInteger('idPresentacion')->unsigned();
            $table->foreign('idPresentacion')->references('id')->on('presentacions');
            $table->primary(['idProducto', 'idPresentacion']);
            $table->integer('unidades');
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
        Schema::dropIfExists('subproductos');
    }
}
