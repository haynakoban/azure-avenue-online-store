<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'paymentId' => $this->payment_id,
            'payerId' => $this->payer_id,
            'payerEmail' => $this->payer_email,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'paymentMethod' => $this->payment_method,
            'paymentStatus' => $this->payment_status,
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
