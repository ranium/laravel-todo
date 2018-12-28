<?php

namespace App\JobPolicies\Todos;

use App\Conditions\Todos\TodoIsPending;
use App\Exceptions\JobPolicy\InvalidStateException;
use App\JobPolicies\JobPolicy;

class MarkTodoCompletedPolicy extends JobPolicy
{
    /**
     * An array of Conditions
     *
     * @var array<Condition>
     */
    protected static $conditions = [
        TodoIsPending::class => InvalidStateException::class,
    ];
}
