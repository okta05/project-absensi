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
        Schema::create('mapels', function (Blueprint $table) {
            $table->id();
            $table->string('nm_mapel')->nullable();
            $table->unsignedBigInteger('id_guru')->nullable();
            $table->string('id_th_pelajaran')->nullable();
            $table->timestamps();
            
            // Tambahkan foreign key constraint jika diperlukan
            $table->foreign('id_guru')->references('id')->on('gurus')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mapels');
    }
};
