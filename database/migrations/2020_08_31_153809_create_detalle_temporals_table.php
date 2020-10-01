<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleTemporalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_temporals', function (Blueprint $table) {
            $table->id();
            $table->double('enero');
            $table->double('febrero');
            $table->double('marzo');
            $table->double('abril');
            $table->double('mayo');
            $table->double('junio');
            $table->double('julio');
            $table->double('agosto');
            $table->double('septiembre');
            $table->double('octubre');
            $table->double('noviembre');
            $table->double('diciembre');
            $table->double('total');
            $table->foreignId('idVenta')->nullable();
            $table->foreignId('idProducto');
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
        Schema::dropIfExists('detalle_temporals');
    }
}
