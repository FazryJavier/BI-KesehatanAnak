<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\LookerStudio;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class LookerStudioPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:LookerStudio');
    }

    public function view(AuthUser $authUser, LookerStudio $lookerStudio): bool
    {
        return $authUser->can('View:LookerStudio');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:LookerStudio');
    }

    public function update(AuthUser $authUser, LookerStudio $lookerStudio): bool
    {
        return $authUser->can('Update:LookerStudio');
    }

    public function delete(AuthUser $authUser, LookerStudio $lookerStudio): bool
    {
        return $authUser->can('Delete:LookerStudio');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:LookerStudio');
    }

    public function restore(AuthUser $authUser, LookerStudio $lookerStudio): bool
    {
        return $authUser->can('Restore:LookerStudio');
    }

    public function forceDelete(AuthUser $authUser, LookerStudio $lookerStudio): bool
    {
        return $authUser->can('ForceDelete:LookerStudio');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:LookerStudio');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:LookerStudio');
    }

    public function replicate(AuthUser $authUser, LookerStudio $lookerStudio): bool
    {
        return $authUser->can('Replicate:LookerStudio');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:LookerStudio');
    }
}
