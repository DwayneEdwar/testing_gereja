<?php

namespace Tests\Unit\Models;

use App\Models\Dokumen;
use App\Models\AnggotaKeluarga;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DokumenTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_fillable_attributes()
    {
        $fillable = ['anggota_keluarga_id', 'jenis', 'file', 'diunggah_oleh'];
        $dokumen = new Dokumen();
        
        $this->assertEquals($fillable, $dokumen->getFillable());
    }

    /** @test */
    public function it_uses_correct_table_name()
    {
        $dokumen = new Dokumen();
        
        $this->assertEquals('dokumen', $dokumen->getTable());
    }

    /** @test */
    public function it_belongs_to_anggota_keluarga()
    {
        $dokumen = Dokumen::factory()->create();
        
        $this->assertInstanceOf(AnggotaKeluarga::class, $dokumen->anggota);
    }

    /** @test */
    public function it_belongs_to_uploader()
    {
        $dokumen = Dokumen::factory()->create();
        
        $this->assertInstanceOf(User::class, $dokumen->uploader);
    }

    /** @test */
    public function it_can_be_created_with_baptis_type()
    {
        $anggotaKeluarga = AnggotaKeluarga::factory()->create();
        $user = User::factory()->create();

        $dokumen = Dokumen::create([
            'anggota_keluarga_id' => $anggotaKeluarga->id,
            'jenis' => 'baptis',
            'file' => 'dokumen/baptis/test.pdf',
            'diunggah_oleh' => $user->id,
        ]);

        $this->assertDatabaseHas('dokumen', [
            'jenis' => 'baptis',
            'file' => 'dokumen/baptis/test.pdf',
        ]);
    }

    /** @test */
    public function it_can_be_created_with_sidi_type()
    {
        $anggotaKeluarga = AnggotaKeluarga::factory()->create();
        $user = User::factory()->create();

        $dokumen = Dokumen::create([
            'anggota_keluarga_id' => $anggotaKeluarga->id,
            'jenis' => 'sidi',
            'file' => 'dokumen/sidi/test.pdf',
            'diunggah_oleh' => $user->id,
        ]);

        $this->assertDatabaseHas('dokumen', [
            'jenis' => 'sidi',
            'file' => 'dokumen/sidi/test.pdf',
        ]);
    }

    /** @test */
    public function it_can_be_updated()
    {
        $dokumen = Dokumen::factory()->create(['jenis' => 'baptis']);

        $dokumen->update(['jenis' => 'sidi']);

        $this->assertEquals('sidi', $dokumen->fresh()->jenis);
    }

    /** @test */
    public function it_can_be_deleted()
    {
        $dokumen = Dokumen::factory()->create();
        $id = $dokumen->id;

        $dokumen->delete();

        $this->assertDatabaseMissing('dokumen', ['id' => $id]);
    }

    /** @test */
    public function it_has_correct_file_path_format()
    {
        $dokumen = Dokumen::factory()->create([
            'file' => 'dokumen/baptis/sample.pdf'
        ]);

        $this->assertStringContainsString('dokumen/', $dokumen->file);
        $this->assertStringEndsWith('.pdf', $dokumen->file);
    }
}