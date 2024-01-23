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
            'amount' => 'required|numeric|max:10000000',
        ];
    }



}
