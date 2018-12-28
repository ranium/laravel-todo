<?php

namespace App\Repositories\Contracts;

use App\User;

interface TodoRepositoryInterface
{
    /**
     * Methdo to return all pending todos
     *
     * @return Collection
     */
    public function allPending(User $user);
}
