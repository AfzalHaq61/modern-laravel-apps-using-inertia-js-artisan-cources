<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    public function create(User $user)
    {
        return $user->email === 'admin1@demo.com';
    }

    public function edit(User $user, User $model)
    {
        return (bool) mt_rand(0, 1);
    }
}
