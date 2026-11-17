<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'author' => ['sometimes', 'required', 'string', 'max:255'],
            'status' => [
                'sometimes',
                'required',
                Rule::in(['to-read', 'reading', 'finished']),
            ],
            'rating' => ['sometimes', 'nullable', 'integer', 'between:1,5'],
        ];
    }
}
