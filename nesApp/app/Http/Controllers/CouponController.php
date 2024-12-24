<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function getCoupon($code)
     {
         // Tìm coupon theo code
         $coupon = Coupon::where('code', $code)->first();
 
         // Kiểm tra nếu coupon tồn tại
         if ($coupon) {
             return response()->json([
                 'success' => true,
                 'data' => $coupon
             ]);
         } else {
             return response()->json([
                 'success' => false,
                 'message' => 'Coupon not found.'
             ], 404);
         }
     }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons|max:255',
            'discount' => 'required|numeric|min:0',
            'status' => 'required|boolean',
        ]);

        Coupon::create($request->all());
        return redirect()->route('admin.coupons')->with('success', 'Coupon created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function update(Request $request, $id)
{
    $coupon = Coupon::findOrFail($id);
    $coupon->code = $request->code;
    $coupon->discount = $request->discount;
    $coupon->status = $request->status;
    $coupon->save();

    return redirect()->route('admin.coupons')->with('success', 'Coupon updated successfully');
}


    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id); 
        $coupon->delete();
        return redirect()->route('admin.coupons')->with('success', 'Coupon deleted successfully.');
    }


    public function applyCoupon(Request $request)
{
    $coupon = Coupon::where('code', $request->code)->first();

    if ($coupon) {
        $discountAmount = $coupon->discount; 
        session(['discount' => $discountAmount]); // Lưu vào session
        return redirect()->back()->with('coupon_message', 'Coupon applied successfully!');
    }

    return redirect()->back()->with('coupon_message', 'Invalid coupon code.');
}
    public function apply(Request $request)
    {
        $request->validate([
            'code' => 'required|string|exists:coupons,code',
        ]);

        $coupon = Coupon::where('code', $request->code)->first();

        if ($coupon) {
            if ($coupon->status === 'disabled') {
                return redirect()->back()->with('coupon_message', 'This coupon is disabled.');
            }
            
            // Giả sử bạn đã lưu tổng giỏ hàng trong session
            $total = Session::get('cart_total', 0); // Hoặc tính toán từ giỏ hàng của bạn
            $discountAmount = ($coupon->discount / 100) * $total; // Tính toán giảm giá
            $totalAfterDiscount = $total - $discountAmount;

            // Lưu tổng sau giảm giá vào session
            Session::put('total_after_discount', $totalAfterDiscount);

            return redirect()->back()->with('coupon_message', 'Coupon applied successfully!')->with('totalAfterDiscount', $totalAfterDiscount);
        }

        return redirect()->back()->with('coupon_message', 'Invalid coupon code.');
    }
}
