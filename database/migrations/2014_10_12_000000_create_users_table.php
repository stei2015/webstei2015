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

            $table->integer('nim')->primary();
            $table->string('username')->unique();
            $table->string('password', 75);
            $table->string('roles');
            $table->dateTime('last_login');
            $table->rememberToken();
            $table->timestamps();

            $table->string('nama_lengkap');
            $table->string('nama_panggilan');

            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');

            $table->string('sma');

            $table->string('alamat_asal');
            $table->string('kota_asal');
            $table->string('provinsi_asal');
            $table->integer('kode_pos_asal');

            $table->string('alamat_studi');
            $table->integer('kode_pos_studi');

            $table->string('hp');
            $table->string('telepon_darurat');
            $table->string('email');
            $table->string('email_students');
            $table->string('line');
            $table->string('twitter');
            $table->string('facebook');

            $table->string('golongan_darah');
            $table->string('riwayat_penyakit');

            $table->string('unit');
            $table->string('bio');
            $table->string('catatan');

            $table->integer('nim_tpb');
            $table->string('prodi');

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
