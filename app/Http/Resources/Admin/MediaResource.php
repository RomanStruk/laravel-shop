<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class MediaResource extends JsonResource
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
            'media_id' => $this->id,
            'url' => $this->url,
            'path' => $this->path,
            'name' => $this->name,
            'keywords' => $this->keywords,
            'description' => $this->description,
            'size' => $this->size,
            'extension' => $this->extension,
            'visibility' => $this->visibility,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'products' => ProductResource::collection($this->whenLoaded('products')),
            'links' => [
                'self' => route('api.v1.admin.media.show', $this),
                'destroy' => route('api.v1.admin.media.destroy', $this),
            ]
        ];
    }
}
