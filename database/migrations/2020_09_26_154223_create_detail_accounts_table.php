<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_accounts', function (Blueprint $table) {
            $table->id();
            $table->longtext('sub_account')->nullable();
            $table->text('division')->nullable();
            $table->text('sub_division')->nullable();
            $table->string('name')->nullable();
            $table->string('debe')->nullable();
            $table->string('haber')->nullable();
            $table->string('tipo')->nullable();
            $table->string('grupo')->nullable();
            $table->string('conasev')->nullable();
            $table->string('saldo')->nullable();
            $table->unsignedBigInteger('plan_of_account_id');
            $table->foreign('plan_of_account_id')->references('id')->on('plans_of_accounts');
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
        Schema::dropIfExists('detail_accounts');
    }
}
