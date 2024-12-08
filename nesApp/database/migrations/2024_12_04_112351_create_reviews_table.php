<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id(); // Khóa chính tự động tăng
            $table->text('content'); // Nội dung đánh giá
            $table->unsignedBigInteger('user_id'); // ID người dùng
            $table->unsignedBigInteger('product_id'); // ID sản phẩm
            $table->tinyInteger('star_rating'); // Số sao đánh giá
            $table->timestamps(); // Thời gian tạo và cập nhật
    
            // Khóa ngoại cho user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // Khóa ngoại cho product_id
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
