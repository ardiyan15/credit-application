<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalculation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calculation', function (Blueprint $table) {
            $table->id();
            $table->float('bunga_per_bulan', 8, 2);
            $table->float('biaya_provisi_admin', 8, 2);
            $table->float('biaya_administrasi', 8, 2);
            $table->string('jenis_agunan');
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
        Schema::dropIfExists('calculation');
    }
}
