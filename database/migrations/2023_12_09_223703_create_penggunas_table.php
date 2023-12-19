<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggunasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penggunas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_posyandu');
            $table->string('nama_pengguna');
            $table->string('email_pengguna');
            $table->string('password_pengguna');
            $table->enum('role', ['A', 'P'])->comment('A : Admin P : Petugas');
            $table->enum('status_akun', ['Y', 'N'])->comment('Y : aktif N : tidak aktif');
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
        Schema::dropIfExists('penggunas');
    }
}
