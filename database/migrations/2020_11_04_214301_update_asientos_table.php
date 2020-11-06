<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAsientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('asientos', function (Blueprint $table) {
            $table->integer('aporte_afiliado_id')->after('comprobante')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('asientos', function (Blueprint $table) {
            $table->dropColumn('aporte_afiliado_id');
        });
    }
}
