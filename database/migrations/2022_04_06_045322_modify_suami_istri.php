<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifySuamiIstri extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suami_istri', function (Blueprint $table) {
            $table->date('tanggal_nikah')->after('tanggal_lahir')->nullable();
            $table->string('status')->after('nama_suami_istri');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suami_istri', function (Blueprint $table) {
            $table->dropColumn('tanggal_nikah');
            $table->dropColumn('status');
        });
    }
}
