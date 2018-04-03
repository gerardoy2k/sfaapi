<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesRoutesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('salesroutes');
        Schema::create('salesroutes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('codeerp');
            $table->string('description');
            $table->string('type')->lenght(1); /* 'P':Preventa 'A':Autoventa */
            $table->string('mobilepass');
            $table->string('orderprefix');
            $table->boolean('salesoverinventory');
            $table->boolean('allowchanges');
            $table->boolean('allowdeposits');
            $table->boolean('allowexportaccountsreceivable');
            $table->boolean('allowexporthistory');
            $table->boolean('status');
            $table->integer('branch_id')->unsigned();
            $table->timestamps();

            $table->foreign('branch_id')->references('id')->on('branches');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salesroutes');
    }
}
