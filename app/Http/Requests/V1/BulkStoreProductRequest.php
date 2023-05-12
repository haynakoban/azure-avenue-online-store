<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class BulkStoreProductRequest extends FormRequest
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
            '*.sellerId' => ['required', 'exists:users,id'],
            '*.categoryId' => ['required', 'exists:categories,id'],
            '*.imageUrl' => ['required'],
            '*.name' => ['required'],
            '*.description' => ['required'],
            '*.price' => ['required', 'numeric'],
            '*.quantity' => ['required', 'integer'],
        ];
    }

    protected function prepareForValidation()
    {
        $data = [];

        foreach ($this->toArray() as $obj) {
            $obj['seller_id'] = $obj['sellerId'] ?? null;
            $obj['category_id'] = $obj['categoryId'] ?? null;
            $obj['image_url'] = $obj['imageUrl'] ?? null;

            $data[] = $obj; 
        }

        $this->merge($data);
    }
}
