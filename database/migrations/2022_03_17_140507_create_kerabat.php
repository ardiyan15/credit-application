<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKerabat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kerabat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap', 100);
            $table->string('jenis_kelamin', 30);
            $table->string('hubungan', 60);
            $table->text('alamat');
            $table->string('kota', 50);
            $table->string('nomor_telepon', 13)->nullable();
            $table->string('no_handphone', 13);
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
        Schema::dropIfExists('kerabat');
    }
}
