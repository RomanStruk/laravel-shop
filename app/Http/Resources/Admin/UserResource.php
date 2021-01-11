<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'user_id' => $this->id,
            'email' => $this->email,
            'email_verified_at' => $this->email_verified_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'full_name' => $this->full_name,
            'status_description' => $this->getStatus($this->detail->status),
            'detail' => new UserDetailResource($this->whenLoaded('detail')),


            'roles' => RoleResource::collection($this->whenLoaded('roles')),
            'links' => [
                'self' => route('api.v1.admin.user.show', $this),
                'destroy' => route('api.v1.admin.user.destroy', $this),
            ]
        ];
    }
}
