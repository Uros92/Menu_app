<?php

namespace App\Observers;

use App\Currency;
use App\Order;

class OrderObserver
{
    /**
     * Handle the order "created" event.
     *
     * @param  \App\Order  $order
     *
     * @return void
     */
    public function created(Order $order)
    {
        $discount = Currency::find($order->currency_id)->discount;

        // If currency is british pound
        if($order->currency_id === 2) {

            //GBP: Send an email with order details. This can be a basic text or
            //html email to any configurable email address.

        }

        //Apply a 2% discount on the total order amount (this needs to be
        //configurable for the currency).
        if($discount) {
            $discount_amount = $order->paid_in_usd / 100 * $discount;
            $final_amount_paid_in_usd = $order->paid_in_usd -  $discount_amount;

            $order->paid_in_usd = $final_amount_paid_in_usd;
            $order->discount_percentage = $discount;
            $order->discount_amount = $discount_amount;
            $order->save();
        }
    }

    /**
     * Handle the order "updated" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function updated(Order $order)
    {
        //
    }

    /**
     * Handle the order "deleted" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the order "restored" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the order "force deleted" event.
     *
     * @param  \App\Order  $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
