<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'district' => $this->district,
            'city' => $this->city,
            'street' => $this->street,
            'status' => $this->status,
            'comment' => $this->comment,
            'avatar' => $this->avatar,
            'identification_type' => $this->identification_type,
            'identification_number' => $this->identification_number,
            'identification_image_1' => $this->identification_image_1,
            'identification_image_2' => $this->identification_image_2,
            'identification_image_3' => $this->identification_image_3,
            'identification_image_4' => $this->identification_image_4,
        ];
    }
}
