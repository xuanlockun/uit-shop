<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function index()
    {
        $order = Order::count();
        $total = Bill::sum('discount_total');
        $cus = User::count();
        $productCounts = Order::select('product_id', DB::raw('count(*) as total_orders'))
            ->groupBy('product_id')
            ->get();

        $productNames = Product::whereIn('id', $productCounts->pluck('product_id'))
            ->pluck('name', 'id');

        $productIds = $productCounts->pluck('product_id');
        $orderCounts = $productCounts->pluck('total_orders');
        $labels = $productIds->map(function ($id) use ($productNames) {
            return $productNames[$id];
        });
        return view('admin.index', compact('total', 'order', 'cus', 'labels', 'orderCounts'));
    }
    public function user()
    {
        $users = User::orderBy('id', 'asc')->paginate(10);
        return view('admin.users', compact('users'));
    }
    public function coupon()
    {
        $coupons = Coupon::orderBy('id', 'asc')->paginate(10);
        return view('admin.coupons', compact('coupons'));
    }
    public function order()
    {
        $bills = Bill::orderBy('id', 'asc')->with('orders.product.sizes')->paginate(10);
        return view('admin.orders', compact('bills'));
    }

    public function product()
    {
        $products = Product::all();
        return view('admin.products', compact('products'));
    }

    // Store a new product
    public function productstore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'required|string|min:0',
        ]);

        Product::create($request->all());

        return redirect()->route('admin.products')->with('success', 'Product created successfully.');
    }

    public function sizestore(Request $request)
    {
        $request->validate([
            'product_id' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'stock' => 'required|numeric|min:0',

        ]);

        ProductSize::create($request->all());

        return redirect()->route('admin.products')->with('success', 'Product created successfully.');
    }

    // Update an existing product
    public function productupdate(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $product->update($request->all());

        return redirect()->route('admin.products')->with('success', 'Product updated successfully.');
    }

    // Delete a product
    public function productdestroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Product deleted successfully.');
    }
}
