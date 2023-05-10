<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCartRequest extends FormRequest
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
        $method = $this->method();

        if ($method == 'PUT') {
            return [
                'userId' => ['required', 'exists:users,id'],
                'productId' => ['required', 'exists:products,id'],
                'quantity' => ['required', 'integer'],
            ];
        } else {
            return [
                'userId' => ['sometimes', 'required', 'exists:users,id'],
                'productId' => ['sometimes', 'required', 'exists:products,id'],
                'quantity' => ['sometimes', 'required', 'integer'], 
            ];
        }
    }

    protected function prepareForValidation()
    {
        if ($this->userId) {
            $this->merge([
                'user_id' => $this->userId
            ]);
        }
        if ($this->productId) {
            $this->merge([
                'product_id' => $this->productId
            ]);
        }     
    }
}
