<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       return[
            'id'=>$this->id,
            'order_date'=>optional($this->order_date)->format('d M Y'),
            'is_blank'=>$this->is_blank,
            'branch_id'=>$this->branch_id,
            'created_by'=>$this->created_by,
            'created_by_name'=>optional(User::select('name')->where('id',$this->created_by)->first())->name,
            'branch_name'=>optional(User::select('name')->where('id',$this->branch_id)->first())->name,
            'receiver_name'=>$this->receiver_name,
            'receiver_email'=>$this->receiver_email,
            'receiver_address'=>$this->receiver_address,
            'receiver_phone'=>$this->receiver_phone,
            'delivery_charge'=>$this->delivery_charge,
            'cod'=>$this->cod,
            'product_name'=>$this->product_name,
            'package_type'=>$this->package_type,
            'delivery_instruction'=>$this->delivery_instruction,
            'note'=>$this->note,
            'delivered'=>$this->delivered,
            'returned'=>$this->returned,
            'latest_status'=>$this->latest_status,
            'sender_name'=>$this->sender_name,
            'sender_number'=>$this->sender_number,
       ];
    }
}
