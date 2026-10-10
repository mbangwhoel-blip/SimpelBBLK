<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('data_uji_resistensis', function (Blueprint $table) {
            $table->enum('status', ['resisten', 'rentan', 'toleran'])
                ->default('resisten')
                ->after('sampel_diperiksa');
            $table->string('mutasi')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('data_uji_resistensis', function (Blueprint $table) {
            $table->dropColumn(['status', 'mutasi']);
        });
    }
};