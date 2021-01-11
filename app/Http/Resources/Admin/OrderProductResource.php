<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
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
            'order_product_id' => $this->id,
            'product_id' => $this->product->id,
            'product_title' => $this->product->title,
            'product_category' => $this->product->category->name,
            'quantity' => $this->count,
            'price' => $this->product->price,
            'total' => $this->getTotalPriceForProduct(),
            'links' => [
                'product' => route('api.v1.admin.product.show', $this->product)
            ]
        ];
    }
}
