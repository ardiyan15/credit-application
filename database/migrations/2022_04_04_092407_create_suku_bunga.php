<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSukuBunga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suku_bunga', function (Blueprint $table) {
            $table->id();
            $table->string('tipe', 3);
            $table->string('kredit_terkecil');
            $table->string('kredit_terbesar');
            $table->float('per_bulan', 8, 2);
            $table->float('per_tahun', 8, 2);
            $table->softDeletes();
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
        Schema::dropIfExists('suku_bunga');
    }
}
