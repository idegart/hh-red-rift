<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
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
            'per_page' => [
                'sometimes',
                'required',
                'integer',
                'min:1',
                'max:100'
            ]
        ];
    }

    public function perPage(): int
    {
        return $this->input('per_page', 20);
    }
}
