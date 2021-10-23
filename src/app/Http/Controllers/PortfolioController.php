<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use InterventionImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Product_image;
use App\Models\User;

class PortfolioController extends Controller
{
    public function index()
    {
        if(!Auth::check())
        {
            return redirect("/login");
        }
        return view('portfolio.index');
    }
    public function create()
    {
        if(!Auth::check())
        {
            return redirect("/login");
        }
        $id = Auth::id();
        $user = User::find($id);
        
        if($user->products()->first())
        {
            return redirect(route('portfolio.edit', ['id' => Auth::id()]));
        }
        return view('portfolio.create');
    }

    public function store(Request $request)
    {
        // dd($request->image);
        $id = Auth::id();
        try{
            foreach($request->item as $item) {
                    DB::transaction(function () use($item, $request, $id) {
                        $product = Product::create([
                            'user_id' => $id,
                            'title' => $item['title'],
                            'description' => $item['description'],
                            'product_url' => $item['url'],
                            'src_url' => $item['src_url'],
                        ]);
                        $i = 0;
                            foreach ($request->file('image') as $file) {
                                $fileName = uniqid(rand().'_');
                                $extension = $file[$i]->extension();
                                $fileNameToStore = $fileName.'.'.$extension;
                                $resizedImage = InterventionImage::make($file[$i])->resize(1920, 1080)->encode();
                                Storage::put('public/portfolio/'.$fileNameToStore, $resizedImage);
                                Product_image::create([
                                    'product_id' => $product->id,
                                    'image_path' => $fileNameToStore,
                                ]);
                                $i++;
                            }
                    }, 2);
            }

        } catch(Throwable $e) {
            Log::error($e);
            throw $e;
        }
        return redirect()->route('portfolio.index');
    }

    
    public function edit($id)
    {

        $portfolio = product::where('user_id' , $id)->get();
        return view('portfolio.edit', compact('portfolio'));

    }

    public function update(Request $request, $id)
    {
        $mypage = User::find($request->id);
        $mypage->title = $request->title;

        $mypage->save();
        return redirect('mypage.index');
    }
}
