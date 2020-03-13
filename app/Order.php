<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'currency_id',
        'exchange_rate',
        'surcharge_percentage',
        'surcharge_amount',
        'foreign_currency_amount',
        'paid_in_usd',
        'discount_percentage',
        'discount_amount'
    ];
}
