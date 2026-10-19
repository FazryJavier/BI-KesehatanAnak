<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\NewsUpdate;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class NewsUpdatePolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:NewsUpdate');
    }

    public function view(AuthUser $authUser, NewsUpdate $newsUpdate): bool
    {
        return $authUser->can('View:NewsUpdate');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:NewsUpdate');
    }

    public function update(AuthUser $authUser, NewsUpdate $newsUpdate): bool
    {
        return $authUser->can('Update:NewsUpdate');
    }

    public function delete(AuthUser $authUser, NewsUpdate $newsUpdate): bool
    {
        return $authUser->can('Delete:NewsUpdate');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('DeleteAny:NewsUpdate');
    }

    public function restore(AuthUser $authUser, NewsUpdate $newsUpdate): bool
    {
        return $authUser->can('Restore:NewsUpdate');
    }

    public function forceDelete(AuthUser $authUser, NewsUpdate $newsUpdate): bool
    {
        return $authUser->can('ForceDelete:NewsUpdate');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:NewsUpdate');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:NewsUpdate');
    }

    public function replicate(AuthUser $authUser, NewsUpdate $newsUpdate): bool
    {
        return $authUser->can('Replicate:NewsUpdate');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:NewsUpdate');
    }
}
