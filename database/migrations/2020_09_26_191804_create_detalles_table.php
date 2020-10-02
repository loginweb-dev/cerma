<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->nullable();
            $table->string('codigo');
            $table->string('name');
            $table->decimal('debe',8,2)->nullable();
            $table->decimal('haber',8,2)->nullable();
            $table->text('glosa')->nullable();
            $table->foreignId('asiento_id')
                  ->constrained();
            $table->string('tipo',10)->nullable();
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
        Schema::dropIfExists('detalles');
    }
}
