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
        Schema::create('kelas', function (Blueprint $table) {
            $table->id('id_kelas');
            $table->string('nm_kelas')->nullable();
            $table->string('tingkat')->nullable();
            $table->unsignedBigInteger('id_wakel')->nullable();
            $table->timestamps();

            // Tambahkan foreign key constraint jika diperlukan
            $table->foreign('id_wakel')->references('id_wakel')->on('wakels')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelas');
    }
};
