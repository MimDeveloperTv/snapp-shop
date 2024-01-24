<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class MinAmountException extends Exception
{
    protected $message = 'min amount limit exception';
    protected $code = Response::HTTP_BAD_REQUEST;
}
