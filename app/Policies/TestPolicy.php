<?php

namespace App\Policies;

use App\Models\Test;
use App\Models\Userss;
use Illuminate\Auth\Access\Response;

class TestPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Users $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Users $user, Test $test): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Users $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Users $user, Test $test): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Users $user, Test $test): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Users $user, Test $test): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Users $user, Test $test): bool
    {
        //
    }
}
