<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Subscriber;
use Brian2694\Toastr\Facades\Toastr;

use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index(){
        $subscribers = Subscriber::latest()->get();
        return view('backend.admin.subscribe', compact('subscribers'));
    }

    public function destroy($id){
        Subscriber::findOrFail($id)->delete();
        Toastr::success('Subscriber delete successfully', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
