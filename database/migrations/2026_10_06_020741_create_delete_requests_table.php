<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('delete_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('data_uji_resistensi_id')
                ->nullable()
                ->constrained('data_uji_resistensis')
                ->nullOnDelete();

            $table->text('alasan');

            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delete_requests');
    }
};