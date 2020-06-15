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
            'name' => $this->name,
            'size' => $this->size,
            'extension' => $this->extension,
            'disc' => $this->disc,
            'links' => [
                'self' => route('api.v1.admin.media.show', $this),
                'destroy' => route('api.v1.admin.media.destroy', $this),
            ]
        ];
    }
}
