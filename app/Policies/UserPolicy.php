<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): Response
    {
        //
//        if (Auth()->user->role_id == ISADMIN) {
            return $user->role_id == ISADMIN
            ? Response::allow()
            : Response::deny('Non puoi visualizzare questo profilo');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): Response
    {
        //
//        if (Auth()->user->role_id == ISADMIN) {
        return $user->role_id == ISADMIN
            ? Response::allow()
            : Response::deny('Non puoi visualizzare questo profilo');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {
        //
//        if (Auth()->user->role_id == ISADMIN) {
        return $user->role_id == ISADMIN
            ? Response::allow()
            : Response::deny('Non puoi visualizzare questo profilo');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): Response
    {
        //
//        if (Auth()->user->role_id == ISADMIN) {
        return $user->role_id == ISADMIN
            ? Response::allow()
            : Response::deny('Non puoi visualizzare questo profilo');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): Response
    {
        //
//        if (Auth()->user->role_id == ISADMIN) {
        return $user->role_id == ISADMIN
            ? Response::allow()
            : Response::deny('Non puoi visualizzare questo profilo');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): Response
    {
        //
//        if (Auth()->user->role_id == ISADMIN) {
        return $user->role_id == ISADMIN
            ? Response::allow()
            : Response::deny('Non puoi visualizzare questo profilo');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): Response
    {
        //
//        if (Auth()->user->role_id == ISADMIN) {
        return $user->role_id == ISADMIN
            ? Response::allow()
            : Response::deny('Non puoi visualizzare questo profilo');
    }
}
