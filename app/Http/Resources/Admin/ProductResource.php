<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'product_id' => $this->id,
            'category_id' => $this->category_id,
            'title' => $this->title,
            'alias' => $this->alias,
            'content' => $this->content,
            'price' => $this->price,
            'old_price' => $this->old_price,
            'quality' => $this->quality(),
            'status' => $this->status,
            'keywords' => $this->keywords,
            'description' => $this->description,
            'visits' => $this->visits,
            'visibility' => $this->visibility,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'media' => MediaResource::collection($this->whenLoaded('media')),
            'related' => ProductResource::collection($this->whenLoaded('related')),
            'syllable' => SyllableResource::collection($this->whenLoaded('syllable')),
            'filters' => FilterResource::collection($this->whenLoaded('product_filters')),
            'links' => [
                'self' => route('api.v1.admin.product.show', $this),
                'update' => route('api.v1.admin.product.update', $this),
                'destroy' => route('api.v1.admin.product.destroy', $this),
            ]
        ];
    }
}
