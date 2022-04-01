<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\Status;

class OrderStatusObserver
{
    /**
     * Handle the OrderStatus "created" event.
     *
     * @param  \App\Models\OrderStatus  $orderStatus
     * @return void
     */

    public function created(OrderStatus $orderStatus)
    {
        $status=Status::where('name',$orderStatus->status)->first();
        if($status && $status->is_delivered==1){
            $orderStatus->order->update([
                'delivered'=>true,
                'latest_status'=>$orderStatus->status,
            ]);
        }elseif($status && $status->is_returned==1){
            $orderStatus->order->update([
                'returned'=>true,
                'latest_status'=>$orderStatus->status,
            ]);
        }
        else{
            $orderStatus->order->update([
                'latest_status'=>$orderStatus->status,
            ]);
        }
    }

    /**
     * Handle the OrderStatus "updated" event.
     *
     * @param  \App\Models\OrderStatus  $orderStatus
     * @return void
     */
    public function updated(OrderStatus $orderStatus)
    {
        $status=Status::where('name',$orderStatus->status)->first();
        if($status && $status->is_delivered==1){
            $orderStatus->order->update([
                'delivered'=>true,
            ]);
        }elseif($status && $status->is_returned==1){
            $orderStatus->order->update([
                'returned'=>true,
            ]);
        }else{

        }
        $orderStatus->order->latest_status=$orderStatus->order->statuses->last()->status;
    }

    /**
     * Handle the OrderStatus "deleted" event.
     *
     * @param  \App\Models\OrderStatus  $orderStatus
     * @return void
     */

     function deleting(OrderStatus $orderStatus)
     {
        $status=Status::where('name',$orderStatus->status)->first();
        if($status && $status->is_delivered==1){
            $orderStatus->order->update([
                'delivered'=>false,
            ]);
        }elseif($status && $status->is_returned==1){
            $orderStatus->order->update([
                'returned'=>false,
            ]);
        }else{

        }
        $orderStatus->order->latest_status=$orderStatus->order->statuses->last()->status;
     }
    public function deleted(OrderStatus $orderStatus)
    {
        $order=Order::where('id',$orderStatus->order_id)->first();
        $order->update([
            'latest_status'=>$order->statuses->last()->status,
        ]);
    }

    /**
     * Handle the OrderStatus "restored" event.
     *
     * @param  \App\Models\OrderStatus  $orderStatus
     * @return void
     */
    public function restored(OrderStatus $orderStatus)
    {
        //
    }

    /**
     * Handle the OrderStatus "force deleted" event.
     *
     * @param  \App\Models\OrderStatus  $orderStatus
     * @return void
     */
    public function forceDeleted(OrderStatus $orderStatus)
    {
        //
    }
}
