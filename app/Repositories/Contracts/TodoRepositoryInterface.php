<?php

namespace App\Repositories\Contracts;

interface TodoRepositoryInterface
{
    /**
     * Methdo to return all pending todos
     *
     * @return Collection
     */
    public function allPending();
}
