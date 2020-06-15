<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'category_id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
            'description' => $this->description,
            'parent_id' => $this->parent_id,
            'parent' => new CategoryResource($this->whenLoaded('parent')),
            'links' => [
                'self' => route('api.v1.admin.category.show', $this),
                'destroy' => route('api.v1.admin.category.destroy', $this),
            ]
        ];
    }
}
