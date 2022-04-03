<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKtpSuamiIstri extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suami_istri', function (Blueprint $table) {
            $table->string('no_ktp')->after('nama_suami_istri');
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
            $table->dropColumn('suami_istri');
        });
    }
}
