<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
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
            'supplier_id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'links' => [
                'self' => route('api.v1.admin.supplier.show', $this),
                'destroy' => route('api.v1.admin.supplier.destroy', $this),
            ]
        ];
    }
}
