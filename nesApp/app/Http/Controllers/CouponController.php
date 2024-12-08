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
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    // public function apply(Request $request)
    // {
    //     $request->validate([
    //         'code' => 'required|string|exists:coupons,code',
    //     ]);

    //     $coupon = Coupon::where('code', $request->code)->first();

    //     if ($coupon) {
    //         if ($coupon->status === 'disabled') {
    //             return response()->json(['success' => false, 'message' => 'This coupon is disabled.']);
    //         }
            
    //         return response()->json(['success' => true, 'discount' => $coupon->discount]);
    //     }

    //     return response()->json(['success' => false, 'message' => 'Invalid coupon code.']);
    // }

    public function applyCoupon(Request $request)
{
    // Kiểm tra mã coupon có hợp lệ hay không
    $coupon = Coupon::where('code', $request->code)->first();

    if ($coupon) {
        // Giả sử discount là số tiền cần giảm
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
