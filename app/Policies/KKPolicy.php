<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\KK;
use Illuminate\Auth\Access\HandlesAuthorization;

class KKPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:KK');
    }

    public function view(AuthUser $authUser, KK $kK): bool
    {
        return $authUser->can('View:KK');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:KK');
    }

    public function update(AuthUser $authUser, KK $kK): bool
    {
        return $authUser->can('Update:KK');
    }

    public function delete(AuthUser $authUser, KK $kK): bool
    {
        return $authUser->can('Delete:KK');
    }

    public function restore(AuthUser $authUser, KK $kK): bool
    {
        return $authUser->can('Restore:KK');
    }

    public function forceDelete(AuthUser $authUser, KK $kK): bool
    {
        return $authUser->can('ForceDelete:KK');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:KK');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:KK');
    }

    public function replicate(AuthUser $authUser, KK $kK): bool
    {
        return $authUser->can('Replicate:KK');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:KK');
    }

}