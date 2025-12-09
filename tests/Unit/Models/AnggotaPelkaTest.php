<?php

namespace Tests\Unit\Models;

use App\Models\AnggotaPelka;
use App\Models\Kelompok;
use App\Models\Pelka;
use App\Models\AnggotaKeluarga;
use App\Models\Dokumen;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnggotaPelkaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_fillable_attributes()
    {
        $fillable = ['kelompok_id', 'pelka_id', 'anggota_keluarga_id'];
        $anggotaPelka = new AnggotaPelka();
        
        $this->assertEquals($fillable, $anggotaPelka->getFillable());
    }

    /** @test */
    public function it_uses_correct_table_name()
    {
        $anggotaPelka = new AnggotaPelka();
        
        $this->assertEquals('anggota_pelka', $anggotaPelka->getTable());
    }

    /** @test */
    public function it_belongs_to_kelompok()
    {
        $anggotaPelka = AnggotaPelka::factory()->create();
        
        $this->assertInstanceOf(Kelompok::class, $anggotaPelka->kelompok);
    }

    /** @test */
    public function it_belongs_to_pelka()
    {
        $anggotaPelka = AnggotaPelka::factory()->create();
        
        $this->assertInstanceOf(Pelka::class, $anggotaPelka->pelka);
    }

    /** @test */
    public function it_belongs_to_anggota_keluarga()
    {
        $anggotaPelka = AnggotaPelka::factory()->create();
        
        $this->assertInstanceOf(AnggotaKeluarga::class, $anggotaPelka->anggotaKeluarga);
    }

    /** @test */
    public function it_has_many_dokumen()
    {
        $anggotaPelka = AnggotaPelka::factory()->create();
        Dokumen::factory()->count(3)->create([
            'anggota_keluarga_id' => $anggotaPelka->anggota_keluarga_id
        ]);
        
        $this->assertCount(3, $anggotaPelka->dokumen);
        $this->assertInstanceOf(Dokumen::class, $anggotaPelka->dokumen->first());
    }

    /** @test */
    public function it_can_be_created_with_valid_data()
    {
        $kelompok = Kelompok::factory()->create();
        $pelka = Pelka::factory()->create();
        $anggotaKeluarga = AnggotaKeluarga::factory()->create();

        $anggotaPelka = AnggotaPelka::create([
            'kelompok_id' => $kelompok->id,
            'pelka_id' => $pelka->id,
            'anggota_keluarga_id' => $anggotaKeluarga->id,
        ]);

        $this->assertDatabaseHas('anggota_pelka', [
            'kelompok_id' => $kelompok->id,
            'pelka_id' => $pelka->id,
            'anggota_keluarga_id' => $anggotaKeluarga->id,
        ]);
    }

    /** @test */
    public function it_can_be_updated()
    {
        $anggotaPelka = AnggotaPelka::factory()->create();
        $newKelompok = Kelompok::factory()->create();

        $anggotaPelka->update(['kelompok_id' => $newKelompok->id]);

        $this->assertEquals($newKelompok->id, $anggotaPelka->fresh()->kelompok_id);
    }

    /** @test */
    public function it_can_be_deleted()
    {
        $anggotaPelka = AnggotaPelka::factory()->create();
        $id = $anggotaPelka->id;

        $anggotaPelka->delete();

        $this->assertDatabaseMissing('anggota_pelka', ['id' => $id]);
    }
}