<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataCheckUpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_check_ups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_posyandu');
            $table->integer('id_anak');
            $table->string('usia_saat_periksa');
            $table->date('tanggal_pemeriksaan');
            $table->string('berat_badan_pemeriksaan');
            $table->string('tinggi_badan_pemeriksaan');
            $table->string('status_gizi');
            $table->enum('status_imunisasi',['Y','N']);
            $table->enum('status_vitamin',['Y','N']);
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
        Schema::dropIfExists('data_check_ups');
    }
}
