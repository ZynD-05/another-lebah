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
        if (!Schema::hasTable('panens')) { // Tambahkan pengecekan tabel
        Schema::create('panens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_lebah_id')->constrained('data_lebahs')->onDelete('cascade');
            $table->date('tanggal_panen');
            $table->integer('jumlah_madu');
            $table->timestamps();
        });
    }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_lebahs');
    }
};
