<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Pelka;
use Illuminate\Auth\Access\HandlesAuthorization;

class PelkaPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Pelka');
    }

    public function view(AuthUser $authUser, Pelka $pelka): bool
    {
        return $authUser->can('View:Pelka');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Pelka');
    }

    public function update(AuthUser $authUser, Pelka $pelka): bool
    {
        return $authUser->can('Update:Pelka');
    }

    public function delete(AuthUser $authUser, Pelka $pelka): bool
    {
        return $authUser->can('Delete:Pelka');
    }

    public function restore(AuthUser $authUser, Pelka $pelka): bool
    {
        return $authUser->can('Restore:Pelka');
    }

    public function forceDelete(AuthUser $authUser, Pelka $pelka): bool
    {
        return $authUser->can('ForceDelete:Pelka');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Pelka');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Pelka');
    }

    public function replicate(AuthUser $authUser, Pelka $pelka): bool
    {
        return $authUser->can('Replicate:Pelka');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Pelka');
    }

}