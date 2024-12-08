<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoCate extends Model
{
    use HasFactory;

    public function product() {
        return $this->belongsTo(Product::class);
    }

    
    public function category() {
        return $this->belongsTo(Category::class);
    }
}
