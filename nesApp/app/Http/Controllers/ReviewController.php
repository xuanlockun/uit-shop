<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'product_id' => 'required|exists:products,id',
            'star_rating' => 'required|integer|min:1|max:5',
        ]);

        // Tạo đánh giá mới
        $review = Review::create([
            'content' => $request->content,
            'user_id' => Auth::id(), // Lấy ID người dùng đã đăng nhập
            'product_id' => $request->product_id,
            'star_rating' => $request->star_rating,
        ]);

        // Cập nhật trường star của sản phẩm
        $product = Product::find($request->product_id);
        
        // Tính toán và cập nhật đánh giá trung bình
        $averageStar = Review::where('product_id', $request->product_id)
            ->avg('star_rating');

        $product->star = round($averageStar); // Làm tròn giá trị trung bình
        $product->save(); // Lưu thay đổi

        return redirect()->back()->with('success', 'Đánh giá của bạn đã được gửi!');
    }
}
