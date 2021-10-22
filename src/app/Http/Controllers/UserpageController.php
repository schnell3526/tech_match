<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

// デバッグ用
use Illuminate\Support\Facades\Log;

class UserpageController extends Controller
{
    public function index(int $id)
    {
         $user = User::find($id);
         $engineer = $user->engineer()->first();
         if(!$engineer)
         {
             return redirect("/mypage/create");
         }
         $products = $user->products()->get();
         $tags = $user->tags()->get();
         $jobs = $user->jobs()->get();
         $products_image = array();
         foreach($products as $product)
         {
             $image = $product->product_images()->first();
             $products_image = array_merge($products_image, array($product->title => $image->image_path));
         }

         return view('userpage', [
             'user' => $user,
             'engineer' => $engineer,
             'products' => $products,
             'tags' => $tags,
             'jobs' => $jobs,
             'products_image' => $products_image,
         ]);
    }
}
