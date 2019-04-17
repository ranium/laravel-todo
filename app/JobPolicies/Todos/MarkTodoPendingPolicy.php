<?php

namespace App\JobPolicies\Todos;

use App\Conditions\Todos\TodoIsCompleted;
use App\Exceptions\JobPolicy\InvalidStateException;
use App\JobPolicies\JobPolicy;

class MarkTodoPendingPolicy extends JobPolicy
{
    /**
     * An array of Conditions
     *
     * @var array<Condition>
     */
    protected static $conditions = [
        TodoIsCompleted::class,
    ];
}
