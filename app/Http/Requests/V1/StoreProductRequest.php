<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'sellerId' => ['required', 'exists:users,id'],
            'categoryId' => ['required', 'exists:categories,id'],
            'imageUrl' => ['required'],
            'name' => ['required'],
            'description' => ['required'],
            'price' => ['required', 'numeric'],
            'quantity' => ['required', 'integer'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'seller_id' => $this->sellerId,
            'category_id' => $this->categoryId,
            'image_url' => $this->imageUrl
        ]);
    }
}
