<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePaymentRequest extends FormRequest
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
                'paymentId' => ['required'],
                'payerId' => ['required'],
                'payerEmail' => ['required', 'email'],
                'amount' => ['required', 'numeric'],
                'currency' => ['required'],
                'paymentMethod' => ['required', Rule::in(['PayPal', 'Cash on delivery'])],
                'paymentStatus' => ['required', Rule::in(['approved', 'declined'])],
            ];
        } else {
            return [
                'paymentId' => ['sometimes', 'required'],
                'payerId' => ['sometimes', 'required'],
                'payerEmail' => ['sometimes', 'required', 'email'],
                'amount' => ['sometimes', 'required', 'numeric'],
                'currency' => ['sometimes', 'required'],
                'paymentMethod' => ['sometimes', 'required', Rule::in(['PayPal', 'Cash on delivery'])],
                'paymentStatus' => ['sometimes', 'required', Rule::in(['approved', 'declined'])],
            ];
        }
    }

    protected function prepareForValidation()
    {
        if ($this->paymentId) {
            $this->merge([
                'payment_id' => $this->paymentId
            ]);
        }
        if ($this->payerId) {
            $this->merge([
                'payer_id' => $this->payerId
            ]);
        }
        if ($this->payerEmail) {
            $this->merge([
                'payer_email' => $this->payerEmail
            ]);
        }
        if ($this->paymentMethod) {
            $this->merge([
                'payment_method' => $this->paymentMethod
            ]);
        }
        if ($this->paymentStatus) {
            $this->merge([
                'payment_status' => $this->paymentStatus
            ]);
        }      
    }
}
