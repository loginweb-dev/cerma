<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibroComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libro_compras', function (Blueprint $table) {
            $table->id();
            $table->integer('mes');
            $table->string('correlativo')->nullable();
            $table->date('fecha_emision')->nullable();
            $table->date('fecha_pago')->nullable();
            $table->integer('tipo_doc')->nullable();
            $table->integer('seriecc')->nullable();
            $table->integer('numeroc')->nullable();
            $table->foreignId('provider_id')->constrained();
            $table->string('bi1')->nullable();
            $table->string('igv1')->nullable();
            $table->string('bi2')->nullable();
            $table->string('igv2')->nullable();
            $table->string('bi3')->nullable();
            $table->string('igv3')->nullable();
            $table->string('nograv')->nullable();
            $table->string('isc')->nullable();
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
        Schema::dropIfExists('libro_compras');
    }
}
