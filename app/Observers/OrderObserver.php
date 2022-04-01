<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\OrderPayments;
use App\Models\OrderStatus;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */

     function creating(Order $order)
     {
        if(!$order->id){
            $order->id=substr(time(),2,10);
        }
         if($order->is_blank==1){
         }else{
             $order->order_date=date('Y-m-d');
             $order->created_by=auth()->user()->id;
         }
         $order->latest_status='Created';
     }

     function created(Order $order){

        $order->statuses()->create([
            'status'=>'Created',
            'status_datetime'=>date('Y-m-d H:i:s'),
        ]);

     }


    /**
     * Handle the Order "updated" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function updating(Order $order)
    {
        $order->updated_by=auth()->user()->id;
        if($order->order_date==null){
            $order->order_date=date('Y-m-d');
            $order->created_by=auth()->user()->id;
        }
    }

    function updated(Order $order){

        if($order->delivered==1){
            OrderPayments::updateOrCreate([
                 'order_id'=>$order->id,
             ],[
                 'customer_id'=>$order->created_by,
                 'branch_id'=>$order->branch_id,
                 'order_id'=>$order->id,
                 'cod'=>$order->cod,
                 'delivery_charge'=>$order->delivery_charge,
                 'total'=>$order->cod-$order->delivery_charge,
             ]);
        }
    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {

    }

    /**
     * Handle the Order "restored" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param  \App\Models\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
