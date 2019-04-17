<?php

namespace App\Conditions\Todos;

use App\Conditions\Condition;
use App\Jobs\Job;
use App\Repositories\Contracts\TodoRepositoryInterface;

class TodoIsCompleted extends Condition
{
    /**
     * @var \App\Repositories\Contracts\TodoRepositoryInterface
     */
    private $todoRepo;

    /**
     * @param Job $job
     */
    public function __construct(Job $job)
    {
        $this->job = $job;
        $this->todoRepo = app(TodoRepositoryInterface::class);
    }

    /**
     * Determine whether the job follows the condition
     *
     * @return boolean
     */
    public function holds()
    {
        return $this->job->getTodo()->completed_at !== null;
    }
}
