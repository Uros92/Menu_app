<?php

namespace App\Http\Controllers;

use App\Currency;

class HomeController extends Controller
{
    public function index()
    {
        $currencies = Currency::all();

        return view('welcome', compact('currencies'));
    }
}
