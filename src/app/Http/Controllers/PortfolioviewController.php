<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class PortfolioviewController extends Controller
{
    public function index($id)
    {
        $product = Product::find($id);
        $images = $product->product_images()->get();
        $user_id = $product->user_id;
        $user = User::find($user_id);
        return view('product', [
            'product' => $product,
            'images' => $images,
            'user' => $user,
        ]);

    }
}
