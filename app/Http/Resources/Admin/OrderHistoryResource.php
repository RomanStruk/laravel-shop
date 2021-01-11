<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderHistoryResource extends JsonResource
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
            'history_id' => $this->id,
            'date_added' => $this->date_added,
            'comment' => $this->comment,
            'status' => $this->status,
            'status_description' => $this->getStatus($this->status),
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
