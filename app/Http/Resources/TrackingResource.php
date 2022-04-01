<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TrackingResource extends JsonResource
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
            'status'=>$this->status,
            'status_datetime'=>$this->status_datetime->format('Y-m-d h:i A'),
            'status_date'=>$this->status_datetime->format('Y-m-d'),
            'status_time'=>$this->status_datetime->format('h:i A'),
            'location'=>$this->location,
            'comment'=>$this->comment,
        ];
    }
}
