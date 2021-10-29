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
        return redirect('/mypage');
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
                if(!empty($item['title'])) {
                      DB::transaction(function () use($item, $id) {
                        $product = Product::create([
                            'user_id' => $id,
                            'title' => $item['title'],
                            'description' => $item['description'],
                            'product_url' => $item['url'],
                            'src_url' => $item['src_url'],
                        ]);
                        // $i = 0;dd
                        // dd($item['image']);
                            foreach ($item['image'] as $file) {
                                // dd($file);
                                $fileName = uniqid(rand().'_');
                                $extension = $file->extension();
                                $fileNameToStore = $fileName.'.'.$extension;
                                $resizedImage = InterventionImage::make($file)->resize(1920, 1080)->encode();
                                Storage::put('public/portfolio/'.$fileNameToStore, $resizedImage);
                                Product_image::create([
                                    'product_id' => $product->id,
                                    'image_path' => $fileNameToStore,
                                ]);
                            } 
                    }, 2);
                }
            }

        } catch(Throwable $e) {
            Log::error($e);
            throw $e;
        }
        return redirect()->route('portfolio.index');
    }

    
    public function edit($id)
    {
        //ポートフォリオテーブルがなければcreateにリダイレクト
        $user = User::find($id);
        $product = $user->products()->first();
        if(!$product)
        {
            return redirect("/portfolio/create");
        }
        $portfolio = Product::with('product_images')->where('user_id' , $id)->get();

        $num = Product::with('product_images')->where('user_id' , $id)->count();
        // dd($portfolio);
        $user_id = Auth::id();
        return view('portfolio.edit', ['portfolio' =>$portfolio, 'user_id' => $user_id, 'num' => $num]);

    }

    public function update(Request $request, $id)
    {
          // dd($request->image);
        // 更新するポートフォリオのID取得
        $product_id = Product::with('product_images')->where('user_id', $id)->get(['id']);
        // 更新するポートフォリオ画像のID取得
        // $product_image_id = [];
        // foreach ($product_id as $pro_id) {
        //     $product_image_id[] = Product_image::where('product_id', $pro_id)->get(['id']);
        // }
        // dd($product_image_id);
        $id = Auth::id();
        try{
            $t = 0;
            foreach($request->item as $item) {
                // dd($request->item);
                    DB::transaction(function () use($item, $product_id, $t) {
                        // dd($product_id[$t]->id);
                        Product::where('id', $product_id[$t]->id)->update([
                            'title' => $item['title'],
                            'description' => $item['description'],
                            'product_url' => $item['url'],
                            'src_url' => $item['src_url'],
                        ]);
                        
                        $i = 0;
                        if (!empty($item['image'])) {
                            $product_count = Product::withCount('product_images')->where('id', $product_id[$t]->id)->get();
                            // dd();
                            foreach ($item['image'] as $file) {
                                $fileName = uniqid(rand().'_');
                                $extension = $file->extension();
                                $fileNameToStore = $fileName.'.'.$extension;
                                $resizedImage = InterventionImage::make($file)->resize(1920, 1080)->encode();
                                Storage::put('public/portfolio/'.$fileNameToStore, $resizedImage);
                                // Product_image::where('id', $product_id[$t]->product_images[$i]->id)->update([
                                //     'image_path' => $fileNameToStore,
                                // ]);
                                Product_image::upsert(
                                    ['product_id' => $product_id[$t]->id, 'image_path' => $fileNameToStore],
                                    ['id'],['image_path']
                                );
                                if ($i < $product_count[0]->product_images_count - 1) {
                                    $i++;
                                }
                                
                            }
                        }
                    }, 2);
                    $t++;
            }

        } catch(Throwable $e) {
            Log::error($e);
            throw $e;
        }
        return redirect()->route('portfolio.index');
    }
}
