<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'order_id' => $this->id,
            'created_at' => $this->created_at->format('d.M.Y h:m'),
            'updated_at' => $this->updated_at->format('j F Yр. h:m'),
            'status' => $this->status,
            'comment' => $this->comment,
            'status_description' => $this->getStatus($this->status),
            'is_editable' => $this->isEditable(),
            'available_list_status' => $this->availableListStatus(),
            'history' => OrderHistoryResource::collection($this->whenLoaded('histories')),
            'payment' => new PaymentResource($this->whenLoaded('payment')),
            'shipping' => new ShippingResource($this->whenLoaded('shipping')),
            'user' => new UserResource($this->whenLoaded('user')),
            'order_products'=> OrderProductResource::collection($this->whenLoaded('orderProducts')),
            'total_products_price' => $this->getSubTotalPrice(),
            'total_price' => $this->getTotalPrice(),
            'links' => [
                'self' => route('api.v1.admin.order.show', $this),
                'destroy' => route('api.v1.admin.order.destroy', $this),
            ]
        ];
    }
}
