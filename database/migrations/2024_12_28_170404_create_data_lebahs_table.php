<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_lebahs', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_lebah');
            $table->date('tanggal_pengadaan');
            $table->json('catatan_panen')->nullable();
            $table->json('catatan_kesehatan')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_lebahs');
    }
};
