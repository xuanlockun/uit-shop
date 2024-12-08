<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "bill_id",
        "product_id",
        "quantity",
        "price",
        "size"
    ];


    public function product() {
        return $this->belongsTo(Product::class);
    }
    public function bill() {
        return $this->belongsTo(Bill::class);
    }
}
