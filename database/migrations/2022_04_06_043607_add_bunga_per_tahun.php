<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBungaPerTahun extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calculation', function (Blueprint $table) {
            $table->float('bunga_per_tahun', 8, 2)->after('bunga_per_bulan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calculation', function (Blueprint $table) {
            $table->dropColumn('bunga_per_tahun');
        });
    }
}
