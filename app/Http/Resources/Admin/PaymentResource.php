<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'payment_id' => $this->id,
            'paid' => $this->paid,
            'method' => $this->method,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
