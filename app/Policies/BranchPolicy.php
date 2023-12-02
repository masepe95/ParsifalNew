<?php

namespace App\Policies;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BranchPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Branch $branch): Response
    {
        if ($branch->cfp->user_id === $user->id) {
            return Response::allow();
        }

        // Controlla se l'utente è associato direttamente al branch
        if ($branch->user_id === $user->id) {
            return Response::allow();
        }

        // Negare l'accesso in tutti gli altri casi
        return Response::deny('Non puoi visualizzare questo profilo');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->role_id === 1
            ? Response::allow()
            : Response::deny('Non puoi visualizzare questo profilo');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Branch $branch): Response
    {
        if ($branch->cfp && $branch->cfp->user_id === $user->id) {
            return Response::allow();
        }

        // Controlla se l'utente è associato direttamente al branch
        if ($branch->user_id === $user->id) {
            return Response::allow();
        }

        // Negare l'accesso in tutti gli altri casi
        return Response::deny('Non puoi visualizzare questo profilo');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Branch $branch): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Branch $branch): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Branch $branch): bool
    {
        return false;
    }
}
