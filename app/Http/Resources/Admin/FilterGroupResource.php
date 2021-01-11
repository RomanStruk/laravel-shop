<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class FilterGroupResource extends JsonResource
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
            'filter_group_id' => $this->id,
            'name' => $this->name,
            'filters' => FilterResource::collection($this->whenLoaded('filters')),
            'links' => [
                'self' => route('api.v1.admin.filter-group.show', $this),
                'destroy' => route('api.v1.admin.filter-group.destroy', $this),
            ]
        ];
    }
}
