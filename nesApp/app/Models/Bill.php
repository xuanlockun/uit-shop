<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "total",
        "discount_amount",
        "discount_total",
        "receiver_id",
        "coupon_ids"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orders() {
        return $this->hasmany(Order::class)->orderBy('status','asc');
    }
    public function receiver() {
        return $this->belongsTo(Receiver::class);
    }
}
