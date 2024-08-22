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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id('id_absensi');
            $table->unsignedBigInteger('id_mapel')->nullable();
            $table->unsignedBigInteger('id_guru')->nullable();
            $table->unsignedBigInteger('id_tahpel')->nullable();
            $table->unsignedBigInteger('id_siswa')->nullable();
            $table->unsignedBigInteger('id_kelas')->nullable();
            $table->string('tanggal')->nullable();
            $table->string('jam')->nullable();
            $table->string('stts_kehadiran')->nullable();
            $table->string('catatan')->nullable();
            $table->timestamps();

            $table->foreign('id_mapel')->references('id_mapel')->on('mapels')->onDelete('set null');
            $table->foreign('id_guru')->references('id_guru')->on('gurus')->onDelete('set null');
            $table->foreign('id_tahpel')->references('id_tahpel')->on('tahpels')->onDelete('set null');
            $table->foreign('id_siswa')->references('id_siswa')->on('siswas')->onDelete('set null');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
