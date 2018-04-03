<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FunctionalityRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('functionality_role');
        Schema::create('functionality_role', function (Blueprint $table) {
            $table->integer('functionality_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('functionality_id')->references('id')->on('functionalities');
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('functionality_role');
    }
}
