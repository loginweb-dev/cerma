<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecepcionAfiliadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recepcion_afiliado', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('afiliado_id')->nullable();
            $table->string('acopio', 255)->nullable();
            $table->decimal('total_litros', 10, 2)->nullable();
            $table->decimal('precio_unidad', 10, 2)->nullable();
            $table->text('observaciones')->nullable();
            $table->date('periodo')->nullable();
            $table->integer('estado')->nullable();
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
        Schema::dropIfExists('recepcion_afiliado');
    }
}
