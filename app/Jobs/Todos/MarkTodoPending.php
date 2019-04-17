<?php

namespace App\Jobs\Todos;

use App\Jobs\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\User;
use App\Todo;

class MarkTodoPending extends Job
{
    /**
     * User adding the todo
     *
     * @var App\User
     */
    public $user;

    /**
     * Todo
     *
     * @var App\Todo
     */
    public $todo;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Todo $todo, User $user)
    {
        $this->todo = $todo;
        $this->user = $user;
    }

    /**
     * Getter for todo
     *
     * @return App\Todo
     */
    public function getTodo()
    {
        return $this->todo;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Make sure all conditions are met (policies satisfy) before accepting the join request
        $this->verifyCompliance();

        $this->todo->completed_at = null;
        return $this->todo->save();
    }
}
