<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bill;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Receiver;

class BillsController extends Controller
{
    public function index() {}
    public function store(Request $request)
    {
        $bill = Bill::create([
            "user_id" => Auth::id(),
            "total" => $request->total,
            "fullname" => $request->fullname,
            "phone" => $request->phone,
            "address" => $request->address,
        ]);
    }
    public function detail($billId)
    {
        $bill = Bill::where('id', $billId)->with('orders.product.sizes','receiver')->first();
        return view('bill.detail', compact('bill'));
    }

    public function cat(Request $request)
    {
        $cartItems = session()->get('cart', []);
        $total = $request->input('total');
        $discountAmount = $request->input('discount_amount');
        $discountedTotal = $request->input('discounted_total');
        $name = $request->input('name');
        $sdt = $request->input('sdt');
        $dc = $request->input('dc');

        $rec = Receiver::create([
            'fullname' => $name,
            'phone' => $sdt,
            'address' => $discountAmount,
        ]);
        $bill = Bill::create([
            'user_id' => Auth::check() ? Auth::id() : null,
            'total' => $total,
            'discount_amount' => $discountAmount,
            'discount_total' => $discountedTotal,
            'receiver_id' => $rec->id,
        ]);

        foreach ($cartItems as $item) {
            Order::create([
                'bill_id' => $bill->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'size' => $item['size']
            ]);
        }

        // session()->forget('cart');
        // return response($item['size']);
        // return redirect()->route('home')->with('success', 'Orders created successfully!');
        return response()->json(['redirect' => route('bill.detail', ['billID' => $bill->id])]);

    }

    public function updateQuantity(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
}
