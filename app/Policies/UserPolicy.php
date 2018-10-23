<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function isSuperAdmin(User $user)
    {
        return count($user->getAllPermissions())  == 15;
    }
}
