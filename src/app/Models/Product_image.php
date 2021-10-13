<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Product_image extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_path',
        'product_id',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
