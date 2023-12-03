<?php

namespace App\Policies;

use App\Models\Branch;
use App\Models\FormationEvent;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FormationEventPolicy
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
    public function view(User $user, FormationEvent $formationEvent): bool
    {
        //return true;
        // Controlla se l'utente è associato direttamente al modello
        $branch = Branch::where($formationEvent->branch_id,'id');
        if ($formationEvent->branch->user_id === $user->id) {
            return Response::allow();
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        return $user->role_id !== 1
            ? Response::allow()
            : Response::deny('Non puoi visualizzare questo profilo');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, FormationEvent $formationEvent): Response
    {
        //return true;

        // Controlla se l'utente è associato direttamente al modello
        $branch = Branch::where($formationEvent->branch_id,'id');
        if ($formationEvent->branch->user_id === $user->id) {
            return Response::allow();
        }
        else{
            return Response::deny();
        }

        // Old: se l'utente NON è un CFP (quindi è Filiale)
        return $user->role_id !== 1
            ? Response::allow()
            : Response::deny('Non puoi visualizzare questo profilo');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, FormationEvent $formationEvent): Response
    {
        return $user->role_id !== 1
            ? Response::allow()
            : Response::deny('Non puoi visualizzare questo profilo');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, FormationEvent $formationEvent): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, FormationEvent $formationEvent): bool
    {
        return true;
    }
}
