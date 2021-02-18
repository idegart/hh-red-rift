<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'payload' => [
                'required',
                'array',
            ],
            'payload.actor' => [
                'sometimes',
                'required',
                'string',
            ],
            'payload.meta' => [
                'sometimes',
                'required',
                'array',
            ],
            'payload.meta.type' => [
                'sometimes',
                'required',
                'string',
            ],
            'payload.meta.color' => [
                'sometimes',
                'nullable',
                'string',
            ],
            'payload.actions' => [
                'sometimes',
                'required',
                'array',
            ],
            'payload.actions.*.action' => [
                'required',
                'string',
            ],
            'payload.actions.*.actor' => [
                'sometimes',
                'required',
                'string',
            ],
        ];
    }
}
