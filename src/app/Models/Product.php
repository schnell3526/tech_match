<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product_image;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'product_url',
        'src_url',
        'user_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function product_images()
    {
        return $this->hasMany(Product_image::class);
    }
}
