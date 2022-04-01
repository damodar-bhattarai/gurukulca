<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'order_id'=>$this->order_id,
            'own_comment'=>$this->user_id==auth()->id(),
            'commented_by'=>new UserResource($this->user),
            'comment'=>$this->comment,
            'edited'=>(bool)$this->edited,
            'commented'=>$this->created_at->diffForHumans(),
        ];
    }
}
