<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void {
        Schema::table('data_uji_resistensis', function (Blueprint $table) {
            $table->string('alamat')->nullable()->after('kabupaten_id');
            $table->string('bulan')->nullable()->after('sampel_diperiksa');
            $table->string('publikasi')->nullable()->after('mutasi');
        });
    }
    public function down(): void {
        Schema::table('data_uji_resistensis', function (Blueprint $table) {
            $table->dropColumn(['alamat','bulan','publikasi']);
        });
    }
};