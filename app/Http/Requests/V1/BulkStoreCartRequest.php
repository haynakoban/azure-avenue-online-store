<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class BulkStoreCartRequest extends FormRequest
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
            '*.userId' => ['required', 'exists:users,id'],
            '*.productId' => ['required', 'exists:products,id'],
            '*.quantity' => ['required', 'integer'],
        ];
    }

    protected function prepareForValidation()
    {
        $data = [];

        foreach ($this->toArray() as $obj) {
            $obj['user_id'] = $obj['userId'] ?? null;
            $obj['product_id'] = $obj['productId'] ?? null;

            $data[] = $obj; 
        }

        $this->merge($data);
    }
}
