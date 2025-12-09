<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\AnggotaKeluarga;
use App\Models\Dokumen;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DokumenUploadTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    /** @test */
    public function user_can_upload_baptis_document()
    {
        $user = User::factory()->create();
        $anggotaKeluarga = AnggotaKeluarga::factory()->create();
        
        $file = UploadedFile::fake()->create('baptis.pdf', 1000, 'application/pdf');

        $dokumen = Dokumen::create([
            'anggota_keluarga_id' => $anggotaKeluarga->id,
            'jenis' => 'baptis',
            'file' => $file->store('dokumen/baptis', 'public'),
            'diunggah_oleh' => $user->id,
        ]);

        $this->assertDatabaseHas('dokumen', [
            'anggota_keluarga_id' => $anggotaKeluarga->id,
            'jenis' => 'baptis',
            'diunggah_oleh' => $user->id,
        ]);

        Storage::disk('public')->assertExists($dokumen->file);
    }

    /** @test */
    public function user_can_upload_sidi_document()
    {
        $user = User::factory()->create();
        $anggotaKeluarga = AnggotaKeluarga::factory()->create();
        
        $file = UploadedFile::fake()->create('sidi.pdf', 1000, 'application/pdf');

        $dokumen = Dokumen::create([
            'anggota_keluarga_id' => $anggotaKeluarga->id,
            'jenis' => 'sidi',
            'file' => $file->store('dokumen/sidi', 'public'),
            'diunggah_oleh' => $user->id,
        ]);

        $this->assertDatabaseHas('dokumen', [
            'anggota_keluarga_id' => $anggotaKeluarga->id,
            'jenis' => 'sidi',
            'diunggah_oleh' => $user->id,
        ]);

        Storage::disk('public')->assertExists($dokumen->file);
    }

    /** @test */
    public function user_can_upload_both_documents_for_same_anggota()
    {
        $user = User::factory()->create();
        $anggotaKeluarga = AnggotaKeluarga::factory()->create();
        
        $fileBaptis = UploadedFile::fake()->create('baptis.pdf', 1000, 'application/pdf');
        $fileSidi = UploadedFile::fake()->create('sidi.pdf', 1000, 'application/pdf');

        $dokumenBaptis = Dokumen::create([
            'anggota_keluarga_id' => $anggotaKeluarga->id,
            'jenis' => 'baptis',
            'file' => $fileBaptis->store('dokumen/baptis', 'public'),
            'diunggah_oleh' => $user->id,
        ]);

        $dokumenSidi = Dokumen::create([
            'anggota_keluarga_id' => $anggotaKeluarga->id,
            'jenis' => 'sidi',
            'file' => $fileSidi->store('dokumen/sidi', 'public'),
            'diunggah_oleh' => $user->id,
        ]);

        $this->assertEquals(2, Dokumen::where('anggota_keluarga_id', $anggotaKeluarga->id)->count());
        Storage::disk('public')->assertExists($dokumenBaptis->file);
        Storage::disk('public')->assertExists($dokumenSidi->file);
    }

    /** @test */
    public function uploaded_file_is_stored_in_correct_directory()
    {
        $user = User::factory()->create();
        $anggotaKeluarga = AnggotaKeluarga::factory()->create();
        
        $file = UploadedFile::fake()->create('test.pdf', 1000, 'application/pdf');

        $dokumen = Dokumen::create([
            'anggota_keluarga_id' => $anggotaKeluarga->id,
            'jenis' => 'baptis',
            'file' => $file->store('dokumen/baptis', 'public'),
            'diunggah_oleh' => $user->id,
        ]);

        $this->assertStringContainsString('dokumen/baptis', $dokumen->file);
    }

    /** @test */
    public function document_records_uploader_information()
    {
        $user = User::factory()->create(['name' => 'Test Uploader']);
        $anggotaKeluarga = AnggotaKeluarga::factory()->create();
        
        $dokumen = Dokumen::create([
            'anggota_keluarga_id' => $anggotaKeluarga->id,
            'jenis' => 'baptis',
            'file' => 'dokumen/baptis/test.pdf',
            'diunggah_oleh' => $user->id,
        ]);

        $this->assertEquals($user->id, $dokumen->uploader->id);
        $this->assertEquals('Test Uploader', $dokumen->uploader->name);
    }
}