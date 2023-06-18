<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user) //controller index()
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model) //controller show()
    {
        return $user->checkRole('user');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user) //controller create(), store()
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model) //controller edit(), update()
    {
        return $user->id === $model->id
            ? Response::allow()
            : Response::deny('You can only edit your own profile.');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model) //controller destroy()
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }
}
