<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsaha extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usaha', function (Blueprint $table) {
            $table->bigInteger('id')->length(11)->unsigined();
            $table->date('berusaha_sejak');
            $table->string('bidang_usaha', 20);
            $table->text('alamat_usaha');
            $table->string('status_kepemilikan', 50);
            $table->integer('jumlah_karyawan', 3);
            $table->string('no_telepon', 13);
            $table->date('ditempati_sejak');
            $table->softDeletes();
            $table->timestamps();
            $table->unsignedBigInteger('nasabah_id');
            $table->foreign('nasabah_id')->references('id')->on('nasabah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usaha');
    }
}
