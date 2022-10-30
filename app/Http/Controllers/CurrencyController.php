<?php

namespace App\Http\Controllers;

use AmrShawky\LaravelCurrency\Facade\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function currency(){
        return view("index",
         ['codes' => Currency::rates()->latest()->get()]);
    }

    public function show(Request $request){
        $request->validate([
            'amount'=> 'numeric|min:0',
            'from' => 'required',
            'to' => 'required'
        ]);

        $convert = Currency::convert()
        ->from($request->from)
        ->to($request->to)
        ->amount($request->amount)
        ->round(2)
        ->get();

        return back()->with(['msg' => $request->amount . ' ' . $request->from . ' is equal to ' . $convert . ' ' . $request->to,
        'amount' => $request->amount,
        'from' => $request->from,
        'to' => $request->to]);
    }
}