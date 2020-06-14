<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class FilterValuesResource extends JsonResource
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
            'filter_option_id' => $this->id,
            'value' => $this->value,
            'links' => [
                'self' => $this->id,
                'destroy' => $this->id,
            ]
        ];
    }
}
