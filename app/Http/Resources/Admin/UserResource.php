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
            'detail' => [
                'first_name' => $this->detail->first_name,
                'last_name' => $this->detail->last_name,
                'phone' => $this->detail->phone,
                'avatar' => $this->detail->avatar,
                'birthday' => $this->detail->birthday,
                'location' => $this->detail->location,
                'status' => $this->detail->status,
            ],


            'roles' => $this->roles,
            'links' => [
                'self' => route('api.admin.media.show', $this),
                'destroy' => route('api.admin.media.destroy', $this),
            ]
        ];
    }
}
