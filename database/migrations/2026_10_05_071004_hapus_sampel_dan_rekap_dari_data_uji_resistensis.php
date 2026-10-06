<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('data_uji_resistensis', 'sampel')) {
            Schema::table('data_uji_resistensis', function (Blueprint $table) {
                $table->dropColumn('sampel');
            });
        }

        if (Schema::hasColumn('data_uji_resistensis', 'rekap')) {
            Schema::table('data_uji_resistensis', function (Blueprint $table) {
                $table->dropColumn('rekap');
            });
        }
    }

    public function down(): void
    {
        Schema::table('data_uji_resistensis', function (Blueprint $table) {
            $table->string('sampel')->nullable();
            $table->text('rekap')->nullable();
        });
    }
};