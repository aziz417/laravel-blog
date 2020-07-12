<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Subscriber;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request, Subscriber $subscriber){
        $request->validate([
            'email' => 'required|email|unique:subscribers'
        ]);
        if(Subscriber::create($request->all())){
            Toastr::success('Thank you for subscribe', 'Success', ["positionClass" => "toast-top-right"]);
            return redirect()->back();
        }
    }
}
