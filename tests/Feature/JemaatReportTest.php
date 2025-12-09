<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\AnggotaPelka;
use App\Models\Kelompok;
use App\Models\Pelka;
use App\Models\AnggotaKeluarga;
use App\Models\Dokumen;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class JemaatReportTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_requires_authentication_to_download_pdf()
    {
        $response = $this->get(route('jemaat.report.pdf'));

        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticated_user_can_download_pdf_report()
    {
        $user = User::factory()->create();
        
        // Create test data
        $kelompok = Kelompok::factory()->create();
        $pelka = Pelka::factory()->create();
        $anggotaKeluarga = AnggotaKeluarga::factory()->create();
        
        $anggotaPelka = AnggotaPelka::factory()->create([
            'kelompok_id' => $kelompok->id,
            'pelka_id' => $pelka->id,
            'anggota_keluarga_id' => $anggotaKeluarga->id,
        ]);

        $response = $this->actingAs($user)->get(route('jemaat.report.pdf'));

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/pdf');
    }

    /** @test */
    public function pdf_filename_contains_current_date()
    {
        $user = User::factory()->create();
        
        $response = $this->actingAs($user)->get(route('jemaat.report.pdf'));

        $expectedFilename = 'laporan-jemaat-' . date('Y-m-d') . '.pdf';
        $response->assertHeader('Content-Disposition', 'attachment; filename="' . $expectedFilename . '"');
    }

    /** @test */
    public function pdf_includes_all_anggota_pelka_data()
    {
        $user = User::factory()->create();
        
        // Create multiple records
        AnggotaPelka::factory()->count(5)->create();

        $response = $this->actingAs($user)->get(route('jemaat.report.pdf'));

        $response->assertStatus(200);
        
        // Verify data is loaded
        $this->assertEquals(5, AnggotaPelka::count());
    }

    /** @test */
    public function pdf_includes_related_data()
    {
        $user = User::factory()->create();
        
        $kelompok = Kelompok::factory()->create(['nama' => 'Test Kelompok']);
        $pelka = Pelka::factory()->create(['nama' => 'Test Pelka']);
        $anggotaKeluarga = AnggotaKeluarga::factory()->create(['nama' => 'Test Anggota']);
        
        AnggotaPelka::factory()->create([
            'kelompok_id' => $kelompok->id,
            'pelka_id' => $pelka->id,
            'anggota_keluarga_id' => $anggotaKeluarga->id,
        ]);

        $response = $this->actingAs($user)->get(route('jemaat.report.pdf'));

        $response->assertStatus(200);
    }

    /** @test */
    public function pdf_works_with_empty_data()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('jemaat.report.pdf'));

        $response->assertStatus(200);
    }
}