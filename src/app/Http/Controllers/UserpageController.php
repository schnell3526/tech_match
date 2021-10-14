<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;



class UserpageController extends Controller
{
    public function index(int $id)
    {
         $user = User::find($id);
         $engineer = $user->engineer()->first();
         $products = $user->products()->get();
         $tags = $user->tags()->get();
         $jobs = $user->jobs()->get();
         $products_images = array();
         foreach($products as $product)
         {
             $images = $product->product_images()->get();
             $product_images = array();
             foreach($images as $image)
             {
                 $product_images = array_merge($product_images, array($image->id => $image->image_path));
             }
             $products_images = array_merge($products_images, array($product->title => $product_images));
             
            
         }

         return view('userpage', [
             'user' => $user,
             'engineer' => $engineer,
             'products' => $products,
             'tags' => $tags,
             'jobs' => $jobs,
             'products_images' => $products_images,

         ]);
    }
}
