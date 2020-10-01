<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateXYZSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('x_y_z_s', function (Blueprint $table) {
            $table->id();
            $table->string('referencia');
            $table->string('descripcion');
            $table->double('media');
            $table->double('desvStd');
            $table->double('coefVar');
            $table->string('tipo');
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
        Schema::dropIfExists('x_y_z_s');
    }
}
