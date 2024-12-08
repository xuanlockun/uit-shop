<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "fullname",
        "user_id",
        "birth",
        "phone",
        "address",
        "level"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
