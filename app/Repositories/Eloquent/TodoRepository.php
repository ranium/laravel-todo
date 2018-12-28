<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\TodoRepositoryInterface;
use App\User;

class TodoRepository extends Repository implements TodoRepositoryInterface
{
    /**
     * Method to get all pending todos
     *
     * @return Collection
     */
    public function allPending(User $user)
    {
        return $this->findAllWhere([
            'user_id' => $user->id,
            'completed_at' => null
        ]);
    }
}
