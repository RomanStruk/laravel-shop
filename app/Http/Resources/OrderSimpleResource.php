<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderSimpleResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'order_id' => $this->id,
            'user' => [
                'user_id' => $this->user->id,
                'full_name' => $this->user->full_name,
                'links' => [
                    'self' => route('api.admin.users.show', $this->user)
                ]
            ],
            'created_at' => $this->created_at->format('d.M.Y h:m'),
            'sum_price' => $this->sum_price,
            'updated_at' => $this->updated_at->format('j F Yр. h:m'),
            'status' => $this->status,
            'status_description' => $this->getStatus($this->status),
            'is_editable' => $this->isEditable(),
            'links' => [
                'self' => route('api.admin.orders.show', $this),
                'destroy' => route('api.admin.orders.destroy', $this),
            ]
        ];
    }
}
