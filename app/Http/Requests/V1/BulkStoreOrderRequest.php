<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            '*.buyerId' => ['required', 'exists:users,id'],
            '*.totalAmount' => ['required', 'numeric'],
            '*.status' => ['required', Rule::in(['cancelled', 'processing', 'completed', 'pending'])],
        ];
    }

    protected function prepareForValidation()
    {
        $data = [];

        foreach ($this->toArray() as $obj) {
            $obj['buyer_id'] = $obj['buyerId'] ?? null;
            $obj['total_amount'] = $obj['totalAmount'] ?? null;

            $data[] = $obj; 
        }

        $this->merge($data);
    }
}
