<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
                'sellerId' => ['required', 'exists:users,id'],
                'categoryId' => ['required', 'exists:categories,id'],
                'imageUrl' => ['required'],
                'name' => ['required'],
                'description' => ['required'],
                'price' => ['required', 'numeric'],
                'quantity' => ['required', 'integer'],
            ];
        } else {
            return [
                'sellerId' => ['sometimes', 'required', 'exists:users,id'],
                'categoryId' => ['sometimes', 'required', 'exists:categories,id'],
                'imageUrl' => ['sometimes', 'required'],
                'name' => ['sometimes', 'required'],
                'description' => ['sometimes', 'required'],
                'price' => ['sometimes', 'required', 'numeric'],
                'quantity' => ['sometimes', 'required', 'integer'],
            ];
        }
    }

    protected function prepareForValidation()
    {
        if ($this->sellerId) {
            $this->merge([
                'seller_id' => $this->sellerId
            ]);
        }
        if ($this->categoryId) {
            $this->merge([
                'category_id' => $this->categoryId
            ]);
        }
        if ($this->imageUrl) {
            $this->merge([
                'image_url' => $this->imageUrl
            ]);
        }   
    }
}
