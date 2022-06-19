<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'user.name' => 'required|string|max:100',
            'user.age' => 'required|date',
            'user.sex' =>'required|string|max:100',
        ];
    }
}
