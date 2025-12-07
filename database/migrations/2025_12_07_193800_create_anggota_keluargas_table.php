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
       Schema::create('anggota_keluarga', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('kk_id');
    $table->string('nama');
    $table->enum('jenis_kelamin', ['L','P']);
    $table->date('tanggal_lahir')->nullable();
    $table->string('status_dalam_keluarga')->nullable();
    $table->boolean('sudah_baptis')->default(false);
    $table->boolean('sudah_sidi')->default(false);
    $table->timestamps();

    $table->foreign('kk_id')
          ->references('id')->on('kk')
          ->cascadeOnDelete();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_keluargas');
    }
};
