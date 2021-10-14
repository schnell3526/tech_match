<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use InterventionImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Product_image;
class PortfolioController extends Controller
{
    public function index()
    {
        return view('portfolio.index');
    }
    public function create()
    {
        return view('portfolio.create');
    }

    public function store(PortfolioRequest $request)
    {
        $id = Auth::id();
        try{
            
            DB::transaction(function () use($request, $id) {
                $product = Product::create([
                    'user_id' => 6,
                    'title' => $request->title,
                    'description' => $request->description,
                    'product_url' => $request->url,
                    'src_url' => $request->src_url,
                ]);

                    foreach ($request->file('image') as $file) {
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
        } catch(Throwable $e) {
            Log::error($e);
            throw $e;
        }

        return redirect()->route('portfolio.index');
    }
}
