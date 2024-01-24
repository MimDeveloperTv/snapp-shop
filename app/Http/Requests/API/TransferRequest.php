<?php

namespace App\Http\Requests\API;

use App\Rules\CardValidate;
use Illuminate\Foundation\Http\FormRequest;

class TransferRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */

    public function rules(): array
    {
        return [
            'source_card_id' => ['required','string',new CardValidate],
            'dest_card_id' => ['required','string',new CardValidate],
            'amount' => 'required|numeric|max:1000000000',
        ];
    }

    public function getSourceCard()
    {
        return $this->input('source_card_id');
    }

    public function getDestCard()
    {
        return $this->input('dest_card_id');
    }

    public function getAmount(): float
    {
        return (float) $this->input('amount');
    }



}
