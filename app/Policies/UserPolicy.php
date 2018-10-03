<?php

namespace App\Policies;

use App\Role;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function isSuperAdmin(User $user)
    {
        return $user->role_id === Role::SUPERADMIN;
    }
}
