<?php

namespace Tests\Unit\Widgets;

use App\Filament\Widgets\JemaatOverviewTable;
use App\Models\AnggotaPelka;
use App\Models\Kelompok;
use App\Models\Pelka;
use App\Models\AnggotaKeluarga;
use App\Models\Dokumen;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JemaatOverviewTableTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_loads_anggota_pelka_with_relations()
    {
        $widget = new JemaatOverviewTable();
        
        // Create test data
        $kelompok = Kelompok::factory()->create(['nama' => 'Test KK']);
        $pelka = Pelka::factory()->create(['nama' => 'Test Pelka']);
        $anggotaKeluarga = AnggotaKeluarga::factory()->create(['nama' => 'Test Anggota']);
        
        AnggotaPelka::factory()->create([
            'kelompok_id' => $kelompok->id,
            'pelka_id' => $pelka->id,
            'anggota_keluarga_id' => $anggotaKeluarga->id,
        ]);

        $query = $widget->getTableQuery();
        $results = $query->get();

        $this->assertCount(1, $results);
        $this->assertTrue($results->first()->relationLoaded('kelompok'));
        $this->assertTrue($results->first()->relationLoaded('anggotaKeluarga'));
        $this->assertTrue($results->first()->relationLoaded('dokumen'));
    }

    /** @test */
    public function it_shows_baptis_status_correctly()
    {
        $anggotaKeluarga = AnggotaKeluarga::factory()->create();
        $anggotaPelka = AnggotaPelka::factory()->create([
            'anggota_keluarga_id' => $anggotaKeluarga->id
        ]);

        // Without baptis document
        $this->assertEquals(0, $anggotaPelka->dokumen->where('jenis', 'baptis')->count());

        // With baptis document
        Dokumen::factory()->create([
            'anggota_keluarga_id' => $anggotaKeluarga->id,
            'jenis' => 'baptis'
        ]);

        $anggotaPelka->refresh();
        $this->assertEquals(1, $anggotaPelka->dokumen->where('jenis', 'baptis')->count());
    }

    /** @test */
    public function it_shows_sidi_status_correctly()
    {
        $anggotaKeluarga = AnggotaKeluarga::factory()->create();
        $anggotaPelka = AnggotaPelka::factory()->create([
            'anggota_keluarga_id' => $anggotaKeluarga->id
        ]);

        // Without sidi document
        $this->assertEquals(0, $anggotaPelka->dokumen->where('jenis', 'sidi')->count());

        // With sidi document
        Dokumen::factory()->create([
            'anggota_keluarga_id' => $anggotaKeluarga->id,
            'jenis' => 'sidi'
        ]);

        $anggotaPelka->refresh();
        $this->assertEquals(1, $anggotaPelka->dokumen->where('jenis', 'sidi')->count());
    }

    /** @test */
    public function it_displays_document_links()
    {
        $user = User::factory()->create();
        $anggotaKeluarga = AnggotaKeluarga::factory()->create();
        $anggotaPelka = AnggotaPelka::factory()->create([
            'anggota_keluarga_id' => $anggotaKeluarga->id
        ]);

        $dokumen = Dokumen::factory()->create([
            'anggota_keluarga_id' => $anggotaKeluarga->id,
            'jenis' => 'baptis',
            'file' => 'dokumen/baptis/test.pdf',
            'diunggah_oleh' => $user->id,
        ]);

        $anggotaPelka->refresh();
        
        $this->assertCount(1, $anggotaPelka->dokumen);
        $this->assertEquals('dokumen/baptis/test.pdf', $anggotaPelka->dokumen->first()->file);
    }

    /** @test */
    public function it_displays_uploader_name()
    {
        $user = User::factory()->create(['name' => 'Admin User']);
        $anggotaKeluarga = AnggotaKeluarga::factory()->create();
        $anggotaPelka = AnggotaPelka::factory()->create([
            'anggota_keluarga_id' => $anggotaKeluarga->id
        ]);

        Dokumen::factory()->create([
            'anggota_keluarga_id' => $anggotaKeluarga->id,
            'jenis' => 'baptis',
            'diunggah_oleh' => $user->id,
        ]);

        $anggotaPelka->refresh();
        
        $this->assertEquals('Admin User', $anggotaPelka->dokumen->first()->uploader->name);
    }

    /** @test */
    public function it_handles_multiple_documents_per_anggota()
    {
        $user = User::factory()->create();
        $anggotaKeluarga = AnggotaKeluarga::factory()->create();
        $anggotaPelka = AnggotaPelka::factory()->create([
            'anggota_keluarga_id' => $anggotaKeluarga->id
        ]);

        Dokumen::factory()->create([
            'anggota_keluarga_id' => $anggotaKeluarga->id,
            'jenis' => 'baptis',
            'diunggah_oleh' => $user->id,
        ]);

        Dokumen::factory()->create([
            'anggota_keluarga_id' => $anggotaKeluarga->id,
            'jenis' => 'sidi',
            'diunggah_oleh' => $user->id,
        ]);

        $anggotaPelka->refresh();
        
        $this->assertCount(2, $anggotaPelka->dokumen);
    }
}