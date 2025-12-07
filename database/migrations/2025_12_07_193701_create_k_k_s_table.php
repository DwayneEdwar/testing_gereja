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
        Schema::create('kk', function (Blueprint $table) {
    $table->id();
    $table->string('nomor_kk')->unique();
     $table->string('name_kk')->unique();
    $table->unsignedBigInteger('kelompok_id');
    $table->string('alamat')->nullable();
    $table->timestamps();

    $table->foreign('kelompok_id')
          ->references('id')->on('kelompok')
          ->cascadeOnDelete();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('k_k_s');
    }
};
