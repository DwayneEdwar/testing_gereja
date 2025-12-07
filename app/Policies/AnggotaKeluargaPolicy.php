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
        return $authUser->can('Update:AnggotaKeluarga');
    }

    public function delete(AuthUser $authUser, AnggotaKeluarga $anggotaKeluarga): bool
    {
        return $authUser->can('Delete:AnggotaKeluarga');
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