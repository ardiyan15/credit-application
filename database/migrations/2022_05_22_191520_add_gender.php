<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGender extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nasabah', function (Blueprint $table) {
            $table->string('jenis_kelamin', 20)->after('nama_lengkap');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nasabah', function (Blueprint $table) {
            $table->dropColumn('jenis_kelamin');
        });
    }
}
