<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', isEmployer::class]);
    }
    public function subscribe(){
        return view('subscription.index');
    }

    public function initPay(Request $request){
        //
        dd("hello");
    }
}
