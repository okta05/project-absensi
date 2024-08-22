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
        Schema::create('absensi__details', function (Blueprint $table) {
            $table->id('id_absensi_detail');
            $table->unsignedBigInteger('id_absensi')->nullable();
            $table->unsignedBigInteger('id_siswa')->nullable();
            $table->string('stts_kehadiran')->nullable();
            $table->string('catatan')->nullable();
            $table->timestamps();

            $table->foreign('id_absensi')->references('id_absensi')->on('absensis')->onDelete('cascade');
            $table->foreign('id_siswa')->references('id_siswa')->on('siswas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi__details');
    }
};
