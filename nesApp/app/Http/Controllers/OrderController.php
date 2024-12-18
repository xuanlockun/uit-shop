<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Receiver;
use App\Models\Bill;
use Illuminate\Support\Facades\Mail;





class OrderController extends Controller
{
    //

    // public function index()
    // {
        
    //     $orders = Order::where('user_id', Auth::id())->where('status','temporary')->with('product')->get();
    //     $customer = Customer::where('user_id', auth()->user()->id)->first();
    //     $receiver = Receiver::where('customer_id',$customer->id)->get();
    //     return view('orders.index', compact('orders','customer','receiver'));
    // }
    public function store(Request $request)
    {
    $productIds = $request->input('product_ids', []);

    if (empty($productIds)) {
        return redirect()->back()->with('success', 'Please pick a product to checkout');
    }

    foreach ($productIds as $productId) {
        $quantity = $request->input('quantity.' . $productId); 
        $cartItem = Cart::where('user_id', Auth::id())
                        ->where('product_id', $productId)
                        ->first();

        if ($cartItem) {
            Order::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $cartItem->product->price,
            ]);
            $cartItem->delete(); 
        }
    }

    return redirect()->route('orders.index'); 
    }

    public function pending($id) {
        $order = Order::find($id);
        if ($order) {
            $order->status = "delivered";
        }
    }
    // public function update(Request $request) {
    //     $bill = Bill::create([
    //         'user_id' => Auth::id(),
    //         'total' => '0',
    //         'fullname' => $request->input('fullname'),
    //         'phone'=> $request->phone,
    //         'address'=> $request->address
    //     ]);
    //     $totalcost = 0;
    //     $orders = $request->input('orders_id',[]);
    //     foreach ($orders as $orderId) {
    //         $order = Order::find($orderId); 
    //         if ($order) {
    //             $order->bill_id = $bill->id;
    //             $order->status = "pending";
    //             $order->save();
    //         }
    //         $totalcost += $order->price * $order->quantity;
    //     }
    //     $bill->update(['total' => $totalcost]);
    //     $customer = Customer::where('user_id', auth()->user()->id)->first();
    //     $data = [
    //         'subject' => 'Purchase Confirmation Email',
    //         'content' => 'Thank you for purchasing from Pony.bit!',
    //         'name' => $customer->fullname,
    //         'billId' => $bill->id
    //     ];
    
    //     Mail::send('emails.test', $data, function($message) use ($data) { 
    //         $message->to(Auth::user()->email, $data['name'])
    //                 ->from('pony.bit@pony.bit', 'Pony.bit') 
    //                 ->subject('Confirmation Email'); 
    //     });
    //     return view('welcome');
    // }
    public function update(Request $request, $id)
    {
        $order = Order::with('sizes')->findOrFail($id);
        if ($request->status === 'ship') {
            $productSize = $order->sizes->where('size',$order->size)->first();
            $productSize->stock -= $order->quantity;
            $productSize->save();
        }
        $order->status = $request->status;
        $order->save();
    
        return redirect()->route('admin.orders')->with('success', 'Coupon updated successfully');
    }
}
