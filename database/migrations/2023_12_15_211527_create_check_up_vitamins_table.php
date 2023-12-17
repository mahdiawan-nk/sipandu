<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckUpVitaminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('check_up_vitamins', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_checkup');
            $table->integer('id_vitamin');
            $table->string('dosis');
            $table->date('tanggal_beri');
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
        Schema::dropIfExists('check_up_vitamins');
    }
}
