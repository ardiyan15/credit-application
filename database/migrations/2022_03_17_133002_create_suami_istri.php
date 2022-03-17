<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuamiIstri extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suami_istri', function (Blueprint $table) {
            $table->id();
            $table->string('nama_suami_istri', 100);
            $table->string('tempat_lahir', 30);
            $table->date('tanggal_lahir');
            $table->string('pendidikan_terakhir', 30);
            $table->string('pekerjaan', 70);
            $table->string('penghasilan', 20);
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
        Schema::dropIfExists('suami_istri');
    }
}
