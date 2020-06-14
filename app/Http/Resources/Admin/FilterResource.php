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
            'values' => FilterValuesResource::collection($this->filterValues),
            'links' => [
                'self' => route('api.admin.filters.show', $this),
                'destroy' => route('api.admin.filters.destroy', $this),
            ]
        ];
    }
}
