<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index() {
        return view('admin.index');
    }
    public function user() {
        $users = User::orderBy('id','asc')->paginate(50);
        return view('admin.users',compact('users'));
    }
    public function coupon() {
        $coupons = Coupon::orderBy('id','asc')->paginate(50);
        return view('admin.coupons',compact('coupons'));
    }
    public function order() {
        $bills = Bill::orderBy('id','asc')->with('orders.product.sizes')->paginate(50);
        return view('admin.orders',compact('bills'));
    }

    
}
