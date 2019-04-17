<?php

namespace App\Repositories\Eloquent;

use App\User;
use App\Repositories\Contracts\TodoRepositoryInterface;

class TodoRepository extends Repository implements TodoRepositoryInterface
{
    /**
     * Method to get all todos for the given user
     *
     * @param \App\User $user User for which the todos are to be fetched
     *
     * @return Collection
     */
    public function allForUser(User $user)
    {
        return $this->findAllWhere(['user_id' => $user->id]);
    }

    /**
     * Method to get all pending todos for the given user
     *
     * @param \App\User $user User for which the todos are to be fetched
     *
     * @return Collection
     */
    public function allPendingForUser(User $user)
    {
        return $this->findAllWhere(
            [
                'user_id' => $user->id,
                'completed_at' => null,
            ]
        );
    }
}
