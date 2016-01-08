<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EventAngelsandmortals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_angelsandmortals', function (Blueprint $table) {
            $table->integer('nim')->primary();
            $table->integer('mortal')->unique();
            $table->integer('guess');
            $table->string('notes');
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
        Schema::drop('event_angelsandmortals');
    }
}
