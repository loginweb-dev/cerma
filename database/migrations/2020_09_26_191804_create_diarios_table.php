<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diarios', function (Blueprint $table) {
            $table->id();
            $table->integer('mes');
            $table->date('fecha');
            $table->string('bouncher');
            $table->string('comprobante');
            $table->string('cta');
            $table->string('nombre');
            $table->string('debe');
            $table->string('haber');
            $table->text('glosa');
            $table->string('cta2')->nullable();
            $table->string('conasev');
            $table->year('year');
            $table->string('cta3')->nullable();
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
        Schema::dropIfExists('diarios');
    }
}
