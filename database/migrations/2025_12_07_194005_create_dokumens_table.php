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
        Schema::create('dokumen', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('anggota_keluarga_id');
    $table->enum('jenis', ['baptis', 'sidi']);
    $table->string('file')->nullable();
    $table->unsignedBigInteger('diunggah_oleh')->nullable();
    $table->timestamps();

    $table->foreign('anggota_keluarga_id')
          ->references('id')->on('anggota_keluarga')
          ->cascadeOnDelete();

    $table->foreign('diunggah_oleh')
          ->references('id')->on('users')
          ->nullOnDelete();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumens');
    }
};
