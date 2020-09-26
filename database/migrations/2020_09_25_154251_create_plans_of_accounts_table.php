<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansOfAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans_of_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->text('element')->nullable();
            $table->string('code')->nullable();
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
        Schema::dropIfExists('plans_of_accounts');
    }
}
