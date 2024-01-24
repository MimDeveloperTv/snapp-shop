<?php

namespace App\Pipes;

use App\Exceptions\MaxAmountException;
use App\Exceptions\MinAmountException;
use App\Models\Transaction;

class MinMaxAmountCheck
{
    public function handle(array $data, \Closure $next)
    {
        throw_if($data['amount'] < Transaction::LIMIT_MIN_AMOUNT, MinAmountException::class);
        throw_if($data['amount'] > Transaction::LIMIT_MAX_AMOUNT, MaxAmountException::class);

        return $next($data);
    }
}
