<?php

namespace App\Actions;

use App\Models\Card;
use App\Models\Transaction;
use Carbon\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;
use Throwable;
use Illuminate\Database\Eloquent\Collection;

class ReportTopTransactionAction
{
    use AsAction;

    /**
     * Execute the action.
     *
     * @throws Throwable
     */
    public function handle(): Collection
    {
        try {

            $topCards =  Transaction::query()
                ->take(3)
                ->selectRaw('id,source_card_id,count(*) as count')
                ->whereBetween('created_at',[Carbon::now()->subMinutes(10),Carbon::now()])
                ->groupBy('source_card_id')
                ->orderBy('count','desc')
                ->get()
                ->pluck('source_card_id')
                ->toArray();


            return Card::query()->whereIn('id',$topCards)
                ->with('account')
                ->get();

        }
        catch (\Exception $exception) {
            return collect();
        }
    }
}
