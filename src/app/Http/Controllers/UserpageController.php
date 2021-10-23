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

             $product_id = "'" . $product->id . "'";
             $products_image = array_merge($products_image, array($product_id => $image->image_path));
             
            

         }

         return view('userpage', [
             'user' => $user,
             'engineer' => $engineer,
             'products' => $products,
             'tags' => $tags,
             'jobs' => $jobs,
             'products_image' => $products_image,
             'mypage' => false,

         ]);
    }
}
