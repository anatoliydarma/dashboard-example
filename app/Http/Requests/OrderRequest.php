<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'option' => 'required|string',
            'note' => 'sometimes|max:255',
            'date' => 'required|date_format:Y-m-d',
            'time' => 'required',
            'adult' => 'required_if:child,0',
            'child' => 'required_if:adult,0',
            'cost' => 'sometimes',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'date' => Carbon::parse($this->get('date'))
                ->startOfDay()
                ->format('Y-m-d'),
            'time' => Carbon::parse($this->get('time'))
            ->format('H:i:s'),
        ]);
    }
}
