<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BulkStorePaymentRequest extends FormRequest
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
            '*.paymentId' => ['required'],
            '*.payerId' => ['required'],
            '*.payerEmail' => ['required', 'email'],
            '*.amount' => ['required', 'numeric'],
            '*.currency' => ['required'],
            '*.paymentMethod' => ['required', Rule::in(['PayPal', 'Cash on delivery'])],
            '*.paymentStatus' => ['required', Rule::in(['approved', 'declined'])],
        ];
    }

    protected function prepareForValidation()
    {
        $data = [];

        foreach ($this->toArray() as $obj) {
            $obj['payment_id'] = $obj['paymentId'] ?? null;
            $obj['payer_id'] = $obj['payerId'] ?? null;
            $obj['payer_email'] = $obj['payerEmail'] ?? null;
            $obj['payment_method'] = $obj['paymentMethod'] ?? null;
            $obj['payment_status'] = $obj['paymentStatus'] ?? null;

            $data[] = $obj; 
        }

        $this->merge($data);
    }
}
