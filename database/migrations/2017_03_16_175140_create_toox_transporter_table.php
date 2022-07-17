<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTooxTransporterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('toox_transporter', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('toox_id')->unsigned();
            $table->integer('transporter_id')->unsigned();
           
        });

        Schema::table('toox_transporter', function (Blueprint $table) {
            $table->foreign('toox_id')->references('id')->on('tooxes');
            $table->foreign('transporter_id')->references('id')->on('transporters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('toox_transporter');
    }
}
