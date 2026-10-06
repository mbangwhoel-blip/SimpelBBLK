<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('data_uji_resistensis', 'bulan')) {
            Schema::table('data_uji_resistensis', function (Blueprint $table) {
                $table->dropColumn('bulan');
            });
        }

        if (Schema::hasColumn('data_uji_resistensis', 'tahun')) {
            Schema::table('data_uji_resistensis', function (Blueprint $table) {
                $table->dropColumn('tahun');
            });
        }
    }

    public function down(): void
    {
        Schema::table('data_uji_resistensis', function (Blueprint $table) {
            $table->integer('bulan')->nullable();
            $table->integer('tahun')->nullable();
        });
    }
};