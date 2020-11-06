<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePeriodoFinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aporte_afiliado', function (Blueprint $table) {
            $table->date('periodo_fin')->after('periodo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aporte_afiliado', function (Blueprint $table) {
            $table->dropColumn('periodo');
        });
    }
}
