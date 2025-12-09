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
        Schema::table('dokumen', function (Blueprint $table) {
            $table->dropColumn('jenis');
            $table->dropColumn('file');
            $table->string('file_baptis')->nullable()->after('anggota_keluarga_id');
            $table->string('file_sidi')->nullable()->after('file_baptis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dokumen', function (Blueprint $table) {
            $table->dropColumn(['file_baptis', 'file_sidi']);
            $table->enum('jenis', ['baptis', 'sidi']);
            $table->string('file')->nullable();
        });
    }
};
