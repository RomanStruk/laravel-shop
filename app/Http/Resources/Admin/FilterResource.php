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
            'name' => $this->name,
            'values' => FilterValuesResource::collection($this->whenLoaded('filterValues')),
            'links' => [
                'self' => route('api.v1.admin.filter.show', $this),
                'destroy' => route('api.v1.admin.filter.destroy', $this),
            ]
        ];
    }
}
