<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTooxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tooxes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('value')->nullable();
            $table->float('price');
            $table->integer('extra_compensation')->nullable();
            $table->string('extra_compensation_reason')->nullable();
            $table->string('size');
            $table->string('picture');
            $table->string('pickup_location');
            $table->float('latpl',30,20);
            $table->float('lngpl',30,20);
            $table->string('delivery_location');
            $table->float('latdl',30,20);
            $table->float('lngdl',30,20);
            $table->date('delivery_deadline')->nullable();
            $table->string('additional_information');
            $table->string('state');
            $table->boolean('status')->default(true);
            $table->string('toox_picture_picker');
            $table->string('toox_picture_receiver');
            $table->integer('picker_id')->unsigned();
            $table->integer('receiver_id')->unsigned();
            $table->integer('sender_id')->unsigned()->nullable();
            $table->integer('transporter_id')->unsigned()->nullable();
          
        });

        Schema::table('tooxes', function (Blueprint $table) {
            $table->foreign('picker_id')->references('id')->on('pickers');
            $table->foreign('receiver_id')->references('id')->on('receivers');
            $table->foreign('sender_id')->references('id')->on('senders');
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
        Schema::dropIfExists('tooxes');
    }
}
