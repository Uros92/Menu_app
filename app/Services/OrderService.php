<?php

namespace App\Services;

use App\Order;

class OrderService {

    public $currency;


    /**
     * @param $currency
     *
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Do logic calculation and store order to database
     *
     *  return void
     */
    public function storeOrder()
    {
        // Amount of order
        $foreign_currency_amount = request()->amount;


        // 1. GET  SURCHARGE PERCENTAGE for given currency
        $surcharge_percentage = $this->getSurchargePercentage();


        // 2. CALCULATE SURCHARGE PERCENTAGE OF ORDER
        $surcharge_amount = $this->getSurchargeAmount($foreign_currency_amount, $surcharge_percentage);


        // 3. ADD SURCHARGE PERCENTAGE TO ORDER
        $order_amount = $foreign_currency_amount + $surcharge_amount;


        // 4. Calculate how much is needed USD for total order amount
        $total_usd_needed_for_order = $this->getTotalNeededUsdToPayTransaction($this->currency->exchange_rate,$order_amount);

        Order::create([
            'currency_id' => $this->currency->id,
            'exchange_rate' => $this->currency->exchange_rate,
            'surcharge_percentage' => $surcharge_percentage,
            'surcharge_amount' => $surcharge_amount,
            'foreign_currency_amount' => $foreign_currency_amount,
            'paid_in_usd' => $total_usd_needed_for_order,
        ]);
    }

    /**
     * Method is called via api
     *
     * Prepare order and return total USD needed
     *
     * @param $amount
     *
     * @return float|int
     */
    public function prepareOrder($amount)
    {
        // Amount of order
        $foreign_currency_amount = $amount;

        // 1. GET  SURCHARGE PERCENTAGE for given currency
        $surcharge_percentage = $this->getSurchargePercentage();

        // 2. CALCULATE SURCHARGE PERCENTAGE OF ORDER
        $surcharge_amount = $this->getSurchargeAmount($foreign_currency_amount, $surcharge_percentage);

        // 3. ADD SURCHARGE PERCENTAGE TO ORDER
        $order_amount = $foreign_currency_amount + $surcharge_amount;

        // 4. Calculate how much is needed USD for total order amount
        $total_usd_needed_for_order = $this->getTotalNeededUsdToPayTransaction($this->currency->exchange_rate,$order_amount);

        // if currency discount exist
        if($this->currency->discount) {
            $total_usd_needed_for_order = $total_usd_needed_for_order -  ($total_usd_needed_for_order / 100 * $this->currency->discount);
        }

        return $total_usd_needed_for_order;
    }


    /**
     * get surcharge percentage for specific currency
     *
     * @return float|int
     */
    public function getSurchargePercentage()
    {
        switch ($this->currency->id) {
            case 1:
                return env('JPY', 7.5);
                break;
            case 2:
                return env('GBP', 5);
                break;
            case 3:
                return env('EUR', 5);
                break;
            default:
                return 0;
        }
    }

    /**
     *
     * calculate surcharge amount
     *
     * @param $foreign_currency_amount
     *
     * @param $surcharge_percentage
     *
     * @return float|int
     */
    public function getSurchargeAmount($foreign_currency_amount, $surcharge_percentage)
    {
        return $foreign_currency_amount / 100 * $surcharge_percentage;
    }

    /**
     * @param $exchange_rate
     *
     * @param $foreign_amount
     *
     * @return float|int
     */
    public function getTotalNeededUsdToPayTransaction($exchange_rate, $foreign_amount)
    {
        $realExchangeRate = 1 / $exchange_rate;

        return  $foreign_amount * $realExchangeRate;
    }

}
