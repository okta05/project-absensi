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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id('id_siswa');
            $table->string('no_absen')->nullable();
            $table->string('nama')->nullable();
            $table->string('nis')->nullable();
            $table->unsignedBigInteger('id_kelas')->nullable();
            $table->string('tgl_lahir')->nullable(); //tgl_lahir : tanggal lahir
            $table->string('tpt_lahir')->nullable(); //tpt_lahir : tempat lahir
            $table->enum('jns_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->text('alamat')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('th_masuk')->nullable();
            $table->string('foto')->nullable();
            $table->text('catatan')->nullable();
            $table->string('nm_ortu')->nullable();
            $table->string('id_tel_ortu')->nullable();
            $table->timestamps();

            $table->foreign('id_kelas')->references('id_kelas')->on('kelas')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
