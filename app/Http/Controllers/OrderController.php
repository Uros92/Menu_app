<?php

namespace App\Http\Controllers;

use App\Currency;
use App\Http\Requests\StoreOrderRequest;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $currency;

    /**
     * OrderController constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->currency = Currency::find($request->currency_id);
    }


    /**
     * @param StoreOrderRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreOrderRequest $request)
    {
        // If validation fails, return back with errors
        if (isset($request->validator) && $request->validator->fails()) {
            return back()->withErrors($request->validator->messages());
        }

        // If everything is ok then store order to database
        (new OrderService())->setCurrency($this->currency)->storeOrder();

        return back()->with('status', 'Order created!');
    }

}
