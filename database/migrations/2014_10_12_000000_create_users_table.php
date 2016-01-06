<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->integer('nim');
            $table->string('username');
            $table->string('password', 75);
            $table->string('role');
            $table->dateTime('lastlogin');
            $table->rememberToken();
            $table->timestamps();

            $table->string('namalengkap');
            $table->string('namapanggilan');

            $table->string('tempatlahir');
            $table->date('tanggallahir');

            $table->string('sma');

            $table->string('alamatasal');
            $table->string('kotaasal');
            $table->string('provinsiasal');
            $table->integer('kodeposasal');

            $table->string('alamatstudi');
            $table->integer('kodeposstudi');

            $table->string('hp');
            $table->string('telepondarurat');
            $table->string('email');
            $table->string('emailstudents');
            $table->string('line');
            $table->string('twitter');
            $table->string('facebook');

            $table->string('golongandarah');
            $table->string('riwayatpenyakit');

            $table->integer('nimtpb');
            $table->string('unit');
            $table->string('bio');
            $table->string('catatan');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
