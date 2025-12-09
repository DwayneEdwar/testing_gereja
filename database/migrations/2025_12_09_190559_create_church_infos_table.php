<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('church_infos', function (Blueprint $table) {
            $table->id();
            $table->string('nama_gereja');
            $table->string('alamat');
            $table->string('gembala_jemaat')->nullable();
            $table->string('kontak_gereja')->nullable();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('church_infos');
    }
};
