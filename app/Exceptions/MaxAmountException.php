<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class MaxAmountException extends Exception
{
    protected $message = 'max amount limit exception';
    protected $code = Response::HTTP_BAD_REQUEST;
}
