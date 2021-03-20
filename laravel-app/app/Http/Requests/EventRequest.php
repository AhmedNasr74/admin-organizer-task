<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
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
