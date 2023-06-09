<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'roleType' => $this->role_type,
            'name' => $this->name,
            'email' => $this->email,
            'provider' => $this->provider,
            'providerId' => $this->provider_id,
            'carts' => CartResource::collection($this->whenLoaded('carts')),
            'orders' => OrderResource::collection($this->whenLoaded('orders')),
            'payments' => PaymentResource::collection($this->whenLoaded('payments')),
            'products' => ProductResource::collection($this->whenLoaded('products')),
        ];
    }
}
