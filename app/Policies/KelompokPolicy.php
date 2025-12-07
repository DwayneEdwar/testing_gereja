<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Kelompok;
use Illuminate\Auth\Access\HandlesAuthorization;

class KelompokPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Kelompok');
    }

    public function view(AuthUser $authUser, Kelompok $kelompok): bool
    {
        return $authUser->can('View:Kelompok');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Kelompok');
    }

    public function update(AuthUser $authUser, Kelompok $kelompok): bool
    {
        return $authUser->can('Update:Kelompok');
    }

    public function delete(AuthUser $authUser, Kelompok $kelompok): bool
    {
        return $authUser->can('Delete:Kelompok');
    }

    public function restore(AuthUser $authUser, Kelompok $kelompok): bool
    {
        return $authUser->can('Restore:Kelompok');
    }

    public function forceDelete(AuthUser $authUser, Kelompok $kelompok): bool
    {
        return $authUser->can('ForceDelete:Kelompok');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Kelompok');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Kelompok');
    }

    public function replicate(AuthUser $authUser, Kelompok $kelompok): bool
    {
        return $authUser->can('Replicate:Kelompok');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Kelompok');
    }

}