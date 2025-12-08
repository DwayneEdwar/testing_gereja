<?php

namespace App\Filament\Resources\Dokumens\Pages;

use App\Filament\Resources\Dokumens\DokumenResource;
use App\Models\Dokumen;
use Filament\Resources\Pages\CreateRecord;

class CreateDokumen extends CreateRecord
{
    protected static string $resource = DokumenResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Simpan data asli untuk digunakan nanti
        $this->originalData = $data;
        
        // Kembalikan data kosong untuk mencegah create default
        // Kita akan handle create secara manual di afterCreate
        return [];
    }

    protected function handleRecordCreation(array $data): \Illuminate\Database\Eloquent\Model
    {
        $anggotaKeluargaId = $this->originalData['anggota_keluarga_id'];
        $diunggahOleh = $this->originalData['diunggah_oleh'];
        
        $createdRecords = [];
        
        // Create dokumen baptis jika ada file
        if (!empty($this->originalData['file_baptis'])) {
            $createdRecords[] = Dokumen::create([
                'anggota_keluarga_id' => $anggotaKeluargaId,
                'jenis' => 'baptis',
                'file' => $this->originalData['file_baptis'],
                'diunggah_oleh' => $diunggahOleh,
            ]);
        }
        
        // Create dokumen sidi jika ada file
        if (!empty($this->originalData['file_sidi'])) {
            $createdRecords[] = Dokumen::create([
                'anggota_keluarga_id' => $anggotaKeluargaId,
                'jenis' => 'sidi',
                'file' => $this->originalData['file_sidi'],
                'diunggah_oleh' => $diunggahOleh,
            ]);
        }
        
        // Return first created record untuk redirect
        return $createdRecords[0] ?? new Dokumen();
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Dokumen berhasil diunggah';
    }
}
