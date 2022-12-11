<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('party_players', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('player');
            $table->foreign('player')->references('id')->on('users');

            $table->unsignedBigInteger('party');
            $table->foreign('party')->references('id')->on('parties');

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
        Schema::dropIfExists('party_players');
    }
};
