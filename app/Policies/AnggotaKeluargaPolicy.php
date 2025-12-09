<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\AnggotaKeluarga;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnggotaKeluargaPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:AnggotaKeluarga');
    }

    public function view(AuthUser $authUser, AnggotaKeluarga $anggotaKeluarga): bool
    {
        return $authUser->can('View:AnggotaKeluarga');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:AnggotaKeluarga');
    }

    public function update(AuthUser $authUser, AnggotaKeluarga $anggotaKeluarga): bool
    {
        // Super admin dapat mengupdate semua data
        if ($authUser->hasRole('super_admin')) {
            return true;
        }

        // Kordinator hanya dapat mengupdate data kelompoknya sendiri
        $kelompokUser = \App\Models\Kelompok::where('ketua_id', $authUser->id)->first();
        if ($kelompokUser && $anggotaKeluarga->kk && $anggotaKeluarga->kk->kelompok_id === $kelompokUser->id) {
            return $authUser->can('Update:AnggotaKeluarga');
        }

        return false;
    }

    public function delete(AuthUser $authUser, AnggotaKeluarga $anggotaKeluarga): bool
    {
        // Super admin dapat menghapus semua data
        if ($authUser->hasRole('super_admin')) {
            return true;
        }

        // Kordinator hanya dapat menghapus data kelompoknya sendiri
        $kelompokUser = \App\Models\Kelompok::where('ketua_id', $authUser->id)->first();
        if ($kelompokUser && $anggotaKeluarga->kk && $anggotaKeluarga->kk->kelompok_id === $kelompokUser->id) {
            return $authUser->can('Delete:AnggotaKeluarga');
        }

        return false;
    }

    public function restore(AuthUser $authUser, AnggotaKeluarga $anggotaKeluarga): bool
    {
        return $authUser->can('Restore:AnggotaKeluarga');
    }

    public function forceDelete(AuthUser $authUser, AnggotaKeluarga $anggotaKeluarga): bool
    {
        return $authUser->can('ForceDelete:AnggotaKeluarga');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:AnggotaKeluarga');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:AnggotaKeluarga');
    }

    public function replicate(AuthUser $authUser, AnggotaKeluarga $anggotaKeluarga): bool
    {
        return $authUser->can('Replicate:AnggotaKeluarga');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:AnggotaKeluarga');
    }

}
