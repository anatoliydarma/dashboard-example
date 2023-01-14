<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ConciergeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'initials' =>  ['required', 'string', 'max:255', Rule::unique('concierges')->ignore($this->id)],
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|max:255',
        ];
    }
}
