<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
    use HasFactory;
    protected $fillable = [
        "user_id",
        "fullname",
        "phone",
        "address"
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function bill() {
        return $this->belongsTo(Bill::class);
    }
}
