<?php

namespace App\Repositories\Contracts;

use App\User;

interface TodoRepositoryInterface
{
    /**
     * Methdo to return all todos for the given user
     *
     * @param \App\User $user User for which the todos are to be fetched
     *
     * @return Collection
     */
    public function allForUser(User $user);

    /**
     * Methdo to return all pending todos
     *
     * @param \App\User $user User for which the todos are to be fetched
     *
     * @return Collection
     */
    public function allPendingForUser(User $user);
}
