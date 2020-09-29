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
            $table->string('bouncher')->nullable();
            $table->string('comprobante')->nullable();
            $table->string('cta')->nullable();
            $table->string('nombre')->nullable();
            $table->string('debe')->nullable();
            $table->string('haber')->nullable();
            $table->text('glosa')->nullable();
            $table->string('cta2')->nullable();
            $table->string('conasev')->nullable();
            $table->year('year')->nullable();
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
