<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StatusResource extends JsonResource
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
            'id'=>$this->id,
            'position'=>$this->position,
            'name'=>$this->name,
            'is_delivered'=>(bool)$this->is_delivered,
            'is_returned'=>(bool)$this->is_returned,
            'send_sms'=>(bool)$this->send_sms,
        ];
    }
}
