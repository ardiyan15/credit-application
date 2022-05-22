<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditTableSkoring extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('skoring_mka', function (Blueprint $table) {
            $table->string('profit_ramai_hari')->after('aset');
            $table->string('profit_sepi_hari')->after('profit_ramai');
            $table->string('profit_normal_hari')->after('profit_normal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('skoring_mka', function (Blueprint $table) {
            $table->dropColumn('profit_ramai_hari');
            $table->dropColumn('profit_sepi_hari');
            $table->dropColumn('profit_normal_hari');
        });
    }
}
