<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePaymentRequest extends FormRequest
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
            'paymentId' => ['required'],
            'payerId' => ['required'],
            'payerEmail' => ['required', 'email'],
            'amount' => ['required', 'numeric'],
            'currency' => ['required'],
            'paymentMethod' => ['required', Rule::in(['PayPal', 'Cash on delivery'])],
            'paymentStatus' => ['required', Rule::in(['approved', 'declined'])],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'payment_id' => $this->paymentId,
            'payer_id' => $this->payerId,
            'payer_email' => $this->payerEmail,
            'payment_method' => $this->paymentMethod,
            'payment_status' => $this->paymentStatus
        ]);
    }
}
