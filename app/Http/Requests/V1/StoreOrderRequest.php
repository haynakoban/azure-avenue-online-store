<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user != null && $user->tokenCan('create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'buyerId' => ['required', 'exists:users,id'],
            'totalAmount' => ['required', 'numeric'],
            'status' => ['required', Rule::in(['cancelled', 'processing', 'completed', 'pending'])],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'buyer_id' => $this->buyerId,
            'total_amount' => $this->totalAmount,
        ]);
    }
}
