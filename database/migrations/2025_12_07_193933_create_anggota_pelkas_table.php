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
       Schema::create('anggota_pelka', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('kelompok_id');
    $table->unsignedBigInteger('pelka_id');
    $table->unsignedBigInteger('anggota_keluarga_id');
    $table->timestamps();

    $table->foreign('kelompok_id')->references('id')->on('kelompok')->cascadeOnDelete();
    $table->foreign('pelka_id')->references('id')->on('pelka')->cascadeOnDelete();
    $table->foreign('anggota_keluarga_id')->references('id')->on('anggota_keluarga')->cascadeOnDelete();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_pelkas');
    }
};
