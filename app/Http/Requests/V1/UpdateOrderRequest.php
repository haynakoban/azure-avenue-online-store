<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user != null && $user->tokenCan('update');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $method = $this->method();

        if ($method == 'PUT') {
            return [
                'buyerId' => ['required', 'exists:users,id'],
                'totalAmount' => ['required', 'numeric'],
                'status' => ['required', Rule::in(['cancelled', 'processing', 'completed', 'pending'])],
            ];
        } else {
            return [
                'buyerId' => ['sometimes', 'required', 'exists:users,id'],
                'totalAmount' => ['sometimes', 'required', 'numeric'],
                'status' => ['sometimes', 'required', Rule::in(['cancelled', 'processing', 'completed', 'pending'])],
            ];
        }
    }

    protected function prepareForValidation()
    {
        if ($this->buyerId) {
            $this->merge([
                'buyer_id' => $this->buyerId
            ]);
        }
        if ($this->totalAmount) {
            $this->merge([
                'total_amount' => $this->totalAmount
            ]);
        }     
    }
}
