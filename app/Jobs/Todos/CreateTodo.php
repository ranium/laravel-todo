<?php

namespace App\Jobs\Todos;

use App\Jobs\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Repositories\Contracts\TodoRepositoryInterface;
use Carbon\Carbon;
use App\User;

class CreateTodo extends Job
{
    /**
     * Job data
     *
     * @var array
     */
    public $data = [];

    /**
     * User adding the todo
     *
     * @var App\User
     */
    public $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Array $jobData, User $user)
    {
        $this->data = $jobData;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(TodoRepositoryInterface $todoRepo)
    {
        // Make sure all conditions are met (policies satisfy) before accepting the join request
        $this->verifyCompliance();

        return $todoRepo->store([
            'title' => $this->data['title'],
            'user_id' => $this->user->id,
            'description' => $this->data['description'],
            'due_at' => $this->data['due_at']? Carbon::parse($this->data['due_at']) : null,
        ]);
    }
}
