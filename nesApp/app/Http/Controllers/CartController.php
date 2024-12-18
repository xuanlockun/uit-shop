<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Receiver;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CartController extends Controller
{
    public function add(Request $request, Product $product)
    {
        $sizeId = $request->input('size');
        $quantity = $request->input('quantity', 1);
        // if (!Auth::check())
        // if (true) {
        //     // return redirect()->route('login');
        //     $cart = session('cart', []);
        //     if (isset($cart[$product->id])) {
        //         $cart[$product->id]['quantity'] += $quantity;
        //     } else {
        //         $cart[$product->id] = [
        //             'product_id' => $product->id,
        //             'product_image' => $product->image,
        //             'name' => $product->name,
        //             'price' => $product->price,
        //             'quantity' => $quantity,
        //             'size' => $sizeId,
        //         ];
        //     }
        //     session(['cart' => $cart]);

        //     return redirect()->back()->with('success', 'Thêm vào giỏ hàng thành công!');
        // }

        $cart = session('cart', []);
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = [
                'product_id' => $product->id,
                'product_image' => $product->image,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'size' => $sizeId,
            ];
        }
        session(['cart' => $cart]);


        // $cart = Cart::where('user_id', Auth::id())
        //     ->where('product_id', $product->id)
        //     ->first();

        // if ($cart) {
        //     $cart->increment('quantity', $quantity);
        // } else {
        //     Cart::create([
        //         'user_id' => Auth::id(),
        //         'product_id' => $product->id,
        //         'quantity' => $quantity,
        //     ]);
        // }

        return redirect()->back()->with('success', 'Thêm vào giỏ hàng thành công!');
    }

    public function testCart()
    {
        $cartItems = session('cart', []);
        // dd($cartItems);
        return view('admin.index', compact('cartItems'));
    }

    public function index()
    {
        $cartItems = session('cart', []);
        if (!Auth::check()) {
            return view('cart.guest', compact('cartItems'));
        }
        $customer = Customer::where('user_id', Auth::id())->first();
        $receivers = Receiver::where('user_id', Auth::id())->get();
        return view('cart.guest', compact('cartItems','receivers','customer'));
    }

    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart->update(['quantity' => $request->quantity]);

        return redirect()->route('cart.index')->with('success', 'Cart updated!');
    }

    public function destroy($cartId)
    {
        $cartItem = Cart::find($cartId);

        if (!$cartItem) {
            return redirect()->route('cart.index')->with('success', 'Cart item not found.');
        }
        $cartItem->delete();
        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }
}
