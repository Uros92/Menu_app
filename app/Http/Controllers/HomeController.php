<?php

namespace App\Http\Controllers;

use App\Currency;
use Cache;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $currencies = Cache::remember('currencies', now()->addMinutes(120), function () {
            return Currency::all();
        });

        return view('welcome', compact('currencies'));
    }
}
