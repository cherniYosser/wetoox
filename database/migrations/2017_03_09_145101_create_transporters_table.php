<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransportersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transporters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cin');
            $table->integer('phone');
            $table->integer('num_driver_license');
            $table->string('car_picture');
            $table->string('car_registration_number');
            $table->string('car_insurance_number');
            $table->string('car_type');
            $table->string('transport_type');
            $table->boolean('status')->default(false);
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('transporters', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transporters');
    }
}
