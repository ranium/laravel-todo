<?php

namespace App\Exceptions\JobPolicy;


abstract class JobPolicyException extends \Exception
{

    /**
     * @var int
     */
    protected static $statusCode = 422;
}
