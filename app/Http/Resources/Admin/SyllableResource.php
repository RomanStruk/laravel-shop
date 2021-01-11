<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\OrderSimpleResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SyllableResource extends JsonResource
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
            'syllable_id' => $this->id,
            'product_id' => $this->product_id,
            'supplier_id' => $this->supplier_id,
            'imported' => $this->imported,
            'remains' => $this->remains,
//            'price' => $this->price,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'countProcessed' => $this->countProcessed,
            'countAvailableRemains' => $this->countAvailableRemains,
            'supplier' => new SupplierResource($this->whenLoaded('supplier')),
            'product' => new ProductResource($this->whenLoaded('product')),
//            'orders' => OrderSimpleResource::collection($this->orders),
            'links' => [
                'self' => route('api.v1.admin.syllable.show', $this),
                'destroy' => route('api.v1.admin.syllable.destroy', $this),
            ]
        ];
    }
}
