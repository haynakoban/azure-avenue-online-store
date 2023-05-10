<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'buyerId' => $this->buyer_id,
            'totalAmount' => $this->total_amount,
            'status' => $this->status,
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
