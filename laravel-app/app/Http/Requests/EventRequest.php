<?php

namespace App\Http\Requests;

use App\Traits\Api\Request\RequestValidationErrorResponse;
use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    use RequestValidationErrorResponse;
    public function rules()
    {
        return [
            'name' => ['required' , 'string' , 'min:2' , 'max:191'],
            'description' => ['nullable' , 'string' ],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
