<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class ShippingResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'shipping_id' => $this->id,
            "shipping_rate" => $this->shipping_rate,
            "method" =>  $this->method,
            "city" =>  $this->city,
            'address' =>  $this->address
        ];
    }
}
