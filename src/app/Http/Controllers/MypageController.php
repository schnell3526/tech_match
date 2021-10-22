<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Engineer;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MypageRequest;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Log;



class MypageController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(function($request, $next) {
            $id= $request->route()->parameter('id');
            if(!is_null($id)) {
                $UserId = User::findOrFail($id)->id;
                $userId = (int)$UserId;
                if($userId !== Auth::id()) {
                    abort(404);
                }
            }
            return $next($request);
        });

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
            return redirect("/mypage/edit");
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
            DB::transaction(function () use($request, $fileNameToStore) {
                $id = Auth::id();
                $user = User::find($id);
                $user->icon_image = $fileNameToStore;
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
        
        }catch(Exception $e) {
            Log::error($e);
            throw $e;
        }

        return redirect()->route('mypage.index');
    }

    public function edit($id)
    {
        // ユーザー情報の取得
        $mypage = User::with(['engineer', 'jobs'])->find($id);

        // 全職種を取得
        $regestered_jobs = Job::all();

        // 設定済職業を配列に格納
        $my_jobs = array();
        foreach ($mypage->jobs as $job){
            $my_jobs[] = $job->name;
        }
        Log::debug(print_r($my_jobs, true));
        // compact()でviewに変数を渡せる。
        return view('users.edit', compact('mypage', 'regestered_jobs', 'my_jobs'));
    }

    // users及びengineersテーブルの更新
    public function update(Request $request)
    {
        // Log::debug(print_r($request->jobs, true));
        try {
            if(!empty($request->icon_image)) {
                // icon_imageが設定されている場合の処理
                // public/iconに$fileNameToStoreという名前で画像を保存
                $fileName = uniqid(rand().'_');
                $extention = $request->file('icon_image')->extension();
                $fileNameToStore = $fileName.'.'.$extention;
                $request->file('icon_image')->storeAs('public/icon', $fileNameToStore);
            }

            // DB操作を一まとめにするための処理
            // https://readouble.com/laravel/8.x/ja/database.html?#database-transactions
            DB::transaction(function () use($request, $fileNameToStore) {
                // Eager Loading
                // https://readouble.com/laravel/8.x/ja/eloquent-relationships.html?#eager-loading
                $mypage = User::with(['engineer', 'jobs'])->find(Auth::id());

                // usersテーブルを変更(表示名、アイコン画像)
                $mypage->nickname = $request->nickname;
                $mypage->icon_image = $fileNameToStore;

                // engineersテーブルを変更(年齢、性別、自己紹介、github、facebook、qiita)
                $mypage->engineer->age = $request->age;
                $mypage->engineer->gender = $request->gender;
                $mypage->engineer->introduction = $request->introduction;
                $mypage->engineer->github_url = $request->github_url;
                $mypage->engineer->facebook_url = $request->facebook_url;
                $mypage->engineer->qiita_url = $request->qiita_url;

                // job_userテーブルを変更
                $mypage->jobs()->sync($request->job_ids);

                // 変更を保存
                $mypage->save();
                $mypage->engineer->save();
            }, 2);
        } catch(Exception $e) {
            // DB更新失敗時の例外処理
            Log::error($e);
            throw $e;
        }
        // マイページへリダイレクト
        return redirect()->route('mypage.index');
    }
}
