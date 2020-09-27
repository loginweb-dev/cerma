<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibroVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libro_ventas', function (Blueprint $table) {
            $table->id();
            $table->integer('mes');
            $table->string('correlativo')->nullable();
            $table->date('fecha_emision')->nullable();
            $table->date('fecha_pago')->nullable();
            $table->integer('tipo_doc')->nullable();
            $table->integer('seriecc')->nullable();
            $table->integer('numeroc')->nullable();
            $table->foreignId('customer_id')->constrained();
            $table->integer('exportacion')->nullable();
            $table->integer('exo')->nullable();
            $table->integer('ina')->nullable();
            $table->integer('isc')->nullable();
            $table->decimal('igv',8,2)->nullable();
            $table->string('otros')->nullable();
            $table->string('dc')->nullable();
            $table->decimal('total',8,2)->nullable();
            $table->decimal('tipo_cambio',8,2)->nullable();
            $table->date('fecha_cm')->nullable();
            $table->string('tipo_cm')->nullable();
            $table->string('serie_cm')->nullable();
            $table->string('nro_cm')->nullable();
            $table->foreignId('asiento_id')
                  ->nullable()
                  ->constrained();
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
        Schema::dropIfExists('libro_ventas');
    }
}
