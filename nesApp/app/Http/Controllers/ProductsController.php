<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\InfoCate;
use App\Models\Order;
class ProductsController extends Controller
{

    public function admin_index() {
        
        $orders = Order::orderBy("id")->paginate(10);
        $products = Product::orderBy("id","asc")->with('sizes')->paginate(20);
        return view("products.indexabc", compact("products","orders"));
    }
    public function index(Request $request)
    {
        $query = $request->input('q');
            
        $products = Product::query(); 
        
        $products->where(function($q) use ($query) {
            if ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%");
            }
        });
    
        $products = $products->paginate(8);
    
        return view('products.index', compact('products'));
    }
    
    public function chill(Request $request)
    {
        $products = Product::take(12)->get();
        
        return view('chill', compact('products'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully!');
    }

    public function detail($id) {
        $product = Product::with('sizes','reviews')->findOrFail($id);
        return view('products.detail', compact('product'));
    }
}
