<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('data_uji_resistensis', function (Blueprint $table) {
            $table->id();

            $table->string('no');

            $table->foreignId('provinsi_id')
                ->constrained('provinsis')
                ->restrictOnDelete();

            $table->foreignId('kabupaten_id')
                ->constrained('kabupatens')
                ->restrictOnDelete();

            $table->string('jenis_nyamuk');

            $table->string('insektisida');

            $table->string('metode');

            $table->integer('sampel_diperiksa');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('data_uji_resistensis');
    }
};