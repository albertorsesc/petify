<?php

namespace App\Http\Resources;

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
            'id' => $this->id,
            'fullName' => $this->fullName(),
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'userType' => new UserTypeResource($this->whenLoaded('userType')),
            'email' => $this->email,
            'phone' => $this->phone,
            'status' => $this->status,
        ];
    }
}
