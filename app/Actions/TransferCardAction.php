<?php

namespace App\Actions;


use App\Events\NotifyEvent;
use App\Events\SmsEvent;
use App\Exceptions\AboveBalanceException;
use App\Exceptions\MaxAmountException;
use App\Exceptions\MinAmountException;
use App\Models\Card;
use App\Models\Transaction;
use App\Models\WageTransaction;
use App\Pipes\BalanceWithWageCheck;
use App\Pipes\MinMaxAmountCheck;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\Concerns\AsAction;
use Throwable;

class TransferCardAction
{
    use AsAction;

    /**
     * Execute the action.
     *
     * @throws Throwable
     */
    public function handle(string $sourceCard,string $destCard,float $amount): array
    {
        try {

            $sourceCard = Card::getCardId($sourceCard);
            $destCard = Card::getCardId($destCard);

            app(Pipeline::class)
                ->send([
                    'source' => $sourceCard,
                    'dest' => $destCard,
                    'amount' => $amount,
                ])
                ->through([
                    MinMaxAmountCheck::class,
                   BalanceWithWageCheck::class,
                ])->thenReturn();


            DB::beginTransaction();
            $upTransaction = Transaction::query()->create([
                'source_card_id' => $sourceCard,
                'dest_card_id' => $destCard,
                'amount' =>  $amount
            ]);

            $amountWithWage = -($amount + Transaction::WAGE_AMOUNT);

            $downTransaction = Transaction::query()->create([
                'source_card_id' => $destCard,
                'dest_card_id' => $sourceCard,
                'amount' =>  $amountWithWage
            ]);

            $downTransaction = WageTransaction::query()->create([
                'source_card_id' => $sourceCard,
                'amount' =>  Transaction::WAGE_AMOUNT
            ]);

            DB::commit();

            SmsEvent::dispatch($sourceCard,SmsEvent::CASH_OUT_TEXT,$amountWithWage);
            SmsEvent::dispatch($destCard,SmsEvent::CASH_IN_TEXT,$amount);


            return [
                'source' => $sourceCard,
                'dest' => $destCard,
                'status' => 'success'
            ];

        }
        catch (AboveBalanceException|MaxAmountException|MinAmountException $exception) {

            DB::rollBack();
            return [
                'code' => $exception->getCode(),
                'message' => $exception->getMessage(),
            ];
        }
    }
}
