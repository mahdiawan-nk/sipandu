<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataPosyandusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_posyandus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama_posyandu');
            $table->string('alamat_posyandu');
            $table->string('kader_posyandu');
            $table->text('informasi_posyandu')->default(null);
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
        Schema::dropIfExists('data_posyandus');
    }
}
