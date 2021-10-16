<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Engineer;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MypageRequest;
use Auth;



class MypageController extends Controller
{
    
    public function __construct()
    {

    }

    public function index()
    {
        if(!Auth::check())
        {
            return redirect("/login");
        }
        $id = Auth::id();
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

    public function create()
    {
        if(!Auth::check())
        {
            return redirect("/login");
        }
        $id = Auth::id();
        $user = User::find($id);
        
        if($user->engineer()->first())
        {
            return redirect(route('mypage.edit', ['id' => $id]));
        }
        $me = User::get();
        return view('users.create', compact('me'));
    }

    public function store(MypageRequest $request)
    {
        try{
            $fileName = uniqid(rand().'_');
            $extention = $request->file('icon_image')->extension();
            $fileNameToStore = $fileName.'.'.$extention;
            $request->file('icon_image')->storeAs('public/icon', $fileNameToStore);
            DB::transaction(function () use($request) {
                // $user = User::update([
                //     'icon_image' => $request->icon_image,
                //     'nickname' => $request->nickname,
                // ]);

                $id = Auth::id();
                $user = User::find($id);
                $user->icon_image = $request->icon_image;
                $user->nickname = $request->nickname;
                $user->save();
                
                Engineer::create([
                    'user_id' => Auth::id(),
                    'age' => $request->age,
                    'gender' => $request->gender,
                    'introduction' => $request->introduction,
                    'github_url' => $request->github_url,
                    'facebook_url' => $request->facebook_url,
                    'qiita_url' => $request->qita_url,
                ]);
            }, 2);
        
        }catch(Throwable $e) {
            Log::error($e);
            throw $e;
        }

        return redirect()->route('mypage.index');
    }

    public function edit($id)
    {
        $mypage = User::with('engineer')->find($id);
        return view('users.edit', compact('mypage'));
    }

    public function update(Request $request, $id)
    {
        $mypage = User::find($request->id);
        $mypage->title = $request->title;

        $mypage->save();
        return redirect('mypage.index');
    }
    
}
