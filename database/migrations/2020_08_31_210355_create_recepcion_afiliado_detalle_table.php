<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecepcionAfiliadoDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recepcion_afiliado_detalle', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('recepcion_afiliado_id')->nullable();
            $table->integer('aporte_id')->nullable();
            $table->decimal('monto', 10, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recepcion_afiliado_detalle');
    }
}
