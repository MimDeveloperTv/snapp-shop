<?php

namespace App\Pipes;

use App\Exceptions\AboveBalanceException;
use App\Exceptions\MaxAmountException;
use App\Exceptions\MinAmountException;
use App\Models\Card;
use App\Models\Transaction;

class BalanceWithWageCheck
{
    public function handle(array $data, \Closure $next)
    {
        $balances = Card::getBalance($data['source']);
        $total = $data['amount'] + Transaction::WAGE_AMOUNT ;
        throw_if($balances < $total, AboveBalanceException::class);

        return $next($data);
    }
}
