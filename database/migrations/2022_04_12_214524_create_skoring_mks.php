<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkoringMks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skoring_mka', function (Blueprint $table) {
            $table->id();
            $table->string('aset', 30);
            $table->string('profit_ramai', 30);
            $table->string('profit_sepi', 30);
            $table->string('profit_normal', 30);
            $table->string('persediaan_aset', 30);
            $table->string('fixed_aset', 30);
            $table->string('laba_perbulan', 30);
            $table->string('laba_pertahun', 30);
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
        Schema::dropIfExists('skoring_mka');
    }
}
