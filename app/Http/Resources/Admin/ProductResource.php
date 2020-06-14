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
            'status' => $this->status,
            'keywords' => $this->keywords,
            'description' => $this->description,
            'visits' => $this->visits,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'category' => new CategoryResource($this->category),
//            'category' => $this->category,
            'links' => [
                'self' => route('api.admin.products.show', $this),
                'destroy' => route('api.admin.products.destroy', $this),
            ]
        ];
    }
}
