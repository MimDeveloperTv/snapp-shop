<?php

namespace App\Http\Controllers\API;

use App\Actions\TransferCardAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\TransferRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CardController extends Controller
{

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
