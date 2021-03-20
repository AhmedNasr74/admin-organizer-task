<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\Api\Request\RequestValidationErrorResponse;

class AdminAuthLoginRequest extends FormRequest
{
    use RequestValidationErrorResponse;

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required' , 'email' , 'exists:users'],
            'password' => ['required']
        ];
    }
}
