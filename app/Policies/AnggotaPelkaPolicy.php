<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\AnggotaPelka;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnggotaPelkaPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:AnggotaPelka');
    }

    public function view(AuthUser $authUser, AnggotaPelka $anggotaPelka): bool
    {
        return $authUser->can('View:AnggotaPelka');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:AnggotaPelka');
    }

    public function update(AuthUser $authUser, AnggotaPelka $anggotaPelka): bool
    {
        return $authUser->can('Update:AnggotaPelka');
    }

    public function delete(AuthUser $authUser, AnggotaPelka $anggotaPelka): bool
    {
        return $authUser->can('Delete:AnggotaPelka');
    }

    public function restore(AuthUser $authUser, AnggotaPelka $anggotaPelka): bool
    {
        return $authUser->can('Restore:AnggotaPelka');
    }

    public function forceDelete(AuthUser $authUser, AnggotaPelka $anggotaPelka): bool
    {
        return $authUser->can('ForceDelete:AnggotaPelka');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:AnggotaPelka');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:AnggotaPelka');
    }

    public function replicate(AuthUser $authUser, AnggotaPelka $anggotaPelka): bool
    {
        return $authUser->can('Replicate:AnggotaPelka');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:AnggotaPelka');
    }

}