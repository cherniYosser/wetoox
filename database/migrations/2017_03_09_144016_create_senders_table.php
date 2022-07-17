<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('senders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('phone')->unique()->nullable();
            $table->integer('cin')->unique()->nullable();
            $table->integer('card_number')->nullable();
            $table->integer('card_password')->nullable();
            $table->boolean('status')->default(false);
            $table->integer('user_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('senders', function (Blueprint $table) {
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
        Schema::dropIfExists('senders');
    }
}
