<?php

namespace App\Http\Requests\API;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Helper\RequestHelper;

class UserRequest extends FormRequest
{
    protected function prepareForValidation()
    {
       $this->merge([
           'mobile' => (int) RequestHelper::faToEn($this->getMobile()),
       ]);
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:60|unique:users',
            'mobile' => 'required|numeric|digits:10|unique:users|regex:/9\d{9}/',
            'password' => 'required|string|min:3',
        ];
    }

    public function getId()
    {
        return $this->input('product_id');
    }

    public function getMobile()
    {
        return $this->input('mobile');
    }


}
