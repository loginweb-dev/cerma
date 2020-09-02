<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAporteAfiliadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aporte_afiliado', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('aporte_id')->nullable();
            $table->integer('afiliado_id')->nullable();
            $table->decimal('monto', 10, 2)->nullable();
            $table->text('observacion')->nullable();
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
        Schema::dropIfExists('aporte_afiliado');
    }
}
