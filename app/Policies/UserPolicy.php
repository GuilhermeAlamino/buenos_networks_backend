<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function isAdmin(User $user)
    {
        return $user->role_id == 1 ? Response::allow()
            : Response::deny('Acesso negado. Esta ação requer permissões administrativas. Por favor, entre em contato com o administrador do sistema.');
    }
}
