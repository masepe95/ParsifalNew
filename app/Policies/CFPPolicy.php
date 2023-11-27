<?php

namespace App\Policies;

use App\Models\CFP;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CFPPolicy
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
    public function view(User $user, CFP $CFP): Response
    {
        return $user->id === $CFP->user_id
            ? Response::allow()
            : Response::deny('Non puoi visualizzare questo profilo');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, CFP $CFP): Response
    {
        return $user->id === $CFP->user_id
            ? Response::allow()
            : Response::deny('Non puoi modificare questo profilo.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CFP $cFP): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CFP $cFP): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CFP $cFP): bool
    {
        return false;
    }
}
