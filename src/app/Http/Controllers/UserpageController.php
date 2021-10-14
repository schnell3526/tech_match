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

         return view('userpage', [
             'user' => $user,
             'engineer' => $engineer,
             'products' => $products,
             'tags' => $tags,
             'jobs' => $jobs,

         ]);
    }
}
