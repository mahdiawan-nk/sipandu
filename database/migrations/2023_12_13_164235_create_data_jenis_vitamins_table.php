<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataJenisVitaminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_jenis_vitamins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_vitamin');
            $table->string('nama_vitamin');
            $table->string('dosis');
            $table->string('jenis');
            $table->string('keterangan')->default(null);
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
        Schema::dropIfExists('data_jenis_vitamins');
    }
}
