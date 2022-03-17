<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalonDebitur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calon_debitur', function (Blueprint $table) {
            $table->id();
            $table->string('penghasilan', 15);
            $table->string('biaya_biaya', 15);
            $table->string('keuntungan', 15);
            $table->string('penghasilan_lainnya', 15);
            $table->string('total_pinjaman_lain', 15);
            $table->string('sisa_waktu_angsuran', 10);
            $table->string('angsuran_pinjaman_lain', 15);
            $table->string('total_penghasilan', 15);
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
        Schema::dropIfExists('calon_debitur');
    }
}
