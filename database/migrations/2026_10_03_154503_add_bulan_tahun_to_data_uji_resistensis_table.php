<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_uji_resistensis', function (Blueprint $table) {
            $table->unsignedTinyInteger('bulan')->after('no');
            $table->unsignedSmallInteger('tahun')->after('bulan');
        });
    }

    public function down(): void
    {
        Schema::table('data_uji_resistensis', function (Blueprint $table) {
            $table->dropColumn(['bulan', 'tahun']);
        });
    }
};