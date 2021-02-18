<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LoginRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'login' => [
                'required',
                Rule::exists((new User)->getTable(), 'login'),
            ],
        ];
    }
}
