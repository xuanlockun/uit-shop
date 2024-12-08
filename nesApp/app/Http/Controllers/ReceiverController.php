<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Receiver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;


class ReceiverController extends Controller
{
    public function index() {
        $receivers = Receiver::where('user_id', Auth::id())->get();

    }
    public function store(Request $request) {
        $customer = Customer::where('user_id', auth()->user()->id)->first();
        $receiver = Receiver::create([
            'customer_id'=> $customer->id,
            'fullname' => $request->input('fullname'),
            'phone'=> $request->input('phone'),
            'address'=> $request->input('address')
        ]);
        return redirect()->route('orders.index'); 
    }
    public function destroy($receiverId) {
        $receiver = Receiver::find($receiverId);
        $receiver->delete();
        return redirect()->route('orders.index');
    }
}
