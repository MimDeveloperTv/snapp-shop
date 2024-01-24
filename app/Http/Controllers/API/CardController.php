<?php

namespace App\Http\Controllers\API;

use App\Actions\TransferCardAction;
use App\Actions\ReportTopTransactionAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\TransferRequest;
use App\Http\Resources\API\ReportCollection;
use App\Models\Card;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * @throws \Throwable
     */
    public function index(): ReportCollection
    {
        return ReportCollection::make(
            ReportTopTransactionAction::make()->handle()
        );
    }

    /**
     * @throws \Throwable
     */
    public function transfer(TransferRequest $request): JsonResponse
    {
        return response()->json(
            TransferCardAction::make()->handle(
                $request->getSourceCard(),
                $request->getDestCard(),
                $request->getAmount(),
            )
        );
    }
}
