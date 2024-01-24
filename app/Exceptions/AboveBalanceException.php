<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class AboveBalanceException extends Exception
{
    protected $message = 'above balance exception';
    protected $code = Response::HTTP_BAD_REQUEST;
}
