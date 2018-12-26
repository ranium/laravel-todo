<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\TodoRepositoryInterface;

class TodoRepository extends Repository implements TodoRepositoryInterface
{
    /**
     * Method to get all pending todos
     *
     * @return Collection
     */
    public function allPending()
    {
        return $this->findAllWhere(['completed_at' => null]);
    }
}
