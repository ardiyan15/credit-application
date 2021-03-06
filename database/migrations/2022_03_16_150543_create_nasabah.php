<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNasabah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nasabah', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap', 100);
            $table->string('tempat_lahir', 30);
            $table->date('tanggal_lahir');
            $table->string('pendidikan_terakhir', 30);
            $table->string('nama_ibu_kandung', 50);
            $table->text('alamat');
            $table->string('kecamatan', 100);
            $table->string('kota', 50);
            $table->string('provinsi', 50);
            $table->string('no_telepon', 13);
            $table->string('kode_pos', 5);
            $table->text('alamat_2')->nullable();
            $table->string('kecamatan_2', 100)->nullable();
            $table->string('kota_2', 50)->nullable();
            $table->string('kode_pos_2', 5)->nullable();
            $table->string('no_ktp', 16);
            $table->string('no_npwp', 15);
            $table->string('status_tempat_tinggal', 50);
            $table->string('lama_tinggal', 30);
            $table->string('status_pernikahan', 50);
            $table->string('jumlah_tanggungan');
            $table->string('no_kartu_keluarga', 16);
            $table->string('jenis_pengajuan', 10);
            $table->string('limit_kredit', 20);
            $table->string('jangka_waktu', 10);
            $table->string('tujuan_penggunaan');
            $table->text('deskripsi');
            $table->string('nama_pemilik_agunan');
            $table->string('nomor_sertifikat');
            $table->string('jenis_agunan');
            $table->string('jenis_pinjaman');
            $table->string('approval_lv_1', 1);
            $table->text('pesan_approval_lv_1')->nullable();
            $table->string('approval_lv_2', 1);
            $table->text('pesan_approval_lv_2')->nullable();
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
        Schema::dropIfExists('nasabah');
    }
}
