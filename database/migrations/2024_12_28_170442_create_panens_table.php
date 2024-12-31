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
        Schema::create('panens', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_lebah');
            $table->date('tanggal_panen');
            $table->integer('jumlah_madu');
            $table->foreign('jenis_lebah')->references('jenis_lebah')->on('data_lebah');
            $table->timestamps();
        });

        Schema::table('panens', function (Blueprint $table) {
            $table->foreign('jenis_lebah')->references('jenis_lebah')->on('data_lebah');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panens');
    }
};
