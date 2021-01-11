<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class FilterResource extends JsonResource
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
            'filter_id' => $this->id,
            'value' => $this->value,
            'filter_group' => new FilterGroupResource($this->whenLoaded('filter_group')),

            'links' => [
                'self' => $this->id,
                'destroy' => $this->id,
            ]
        ];
    }
}
