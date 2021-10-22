<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Engineer;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MypageRequest;
use App\Models\Job;
use App\Models\Tag;
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

    // エンジニア情報の新規登録ページを表示
    public function create()
    {
        if (!Auth::check()) {
            // ログインしていなかったらリダイレクト
            return redirect("/login");
        }

        // idとユーザー情報を取得
        $id = Auth::id();
        $user = User::find($id);
        
        if($user->engineer()->first())
        {
            // 登録済みなら編集画面へリダイレクト
            return redirect("/mypage/edit");
        }

        // スキルと職種一覧を取得
        $all_jobs = Job::all();
        $all_tags = Tag::all();

        return view('users.create', compact(['all_jobs', 'all_tags']));
    }

    // マイページ情報の新規登録
    public function store(MypageRequest $request)
    {
        try{
            if(!empty($request->icon_image)) {
                // icon_imageが設定されている場合の処理
                // public/iconに$fileNameToStoreという名前で画像を保存
                $fileName = uniqid(rand().'_');
                $extention = $request->file('icon_image')->extension();
                $fileNameToStore = $fileName.'.'.$extention;
                $request->file('icon_image')->storeAs('public/icon', $fileNameToStore);
            }

            DB::transaction(function () use($request, $fileNameToStore) {
                $id = Auth::id();
                $user = User::find($id);
                $user->icon_image = $fileNameToStore;
                $user->nickname = $request->nickname;
                $user->save();
                
                User::create([
                    'nickname' => $request->nickname,
                    'icon_image' => $fileNameToStore,
                ]);

                Engineer::create([
                    'user_id' => Auth::id(),
                    'age' => $request->age,
                    'gender' => $request->gender,
                    'introduction' => $request->introduction,
                    'github_url' => $request->github_url,
                    'facebook_url' => $request->facebook_url,
                    'qiita_url' => $request->qiita_url,
                ]);

                // job_userテーブルを変更
                $user->jobs()->sync($request->job_ids);
                // tag_userテーブルを変更
                $user->tags()->sync($request->tag_ids);
            }, 2);
        }catch(Exception $e) {
            Log::error($e);
            throw $e;
        }
        return redirect()->route('mypage.index');
    }

    // 編集画面の表示
    public function edit($id)
    {
        // DB操作を一まとめにするための処理
        // https://readouble.com/laravel/8.x/ja/database.html?#database-transactions
        // ユーザー情報の取得
        $mypage = User::with(['engineer', 'jobs', 'tags'])->find($id);
        // 全職種を取得
        $all_jobs = Job::all();
        // 全タグを取得
        $all_tags = Tag::all();

        // 自身の設定済み職業を配列に格納
        $my_jobs = array();
        foreach ($mypage->jobs as $job){
            $my_jobs[] = $job->name;
        }

        // 自身の設定済みタグを配列に格納
        $my_tags = array();
        foreach ($mypage->tags as $tag){
            $my_tags[] = $tag->name;
        }

        // compact()でviewに変数を渡せる。
        return view('users.edit', compact('mypage', 'all_jobs', 'my_jobs', 'all_tags', 'my_tags'));
    }

    // users及びengineersテーブルの更新
    public function update(Request $request)
    {
        try {
            if(!empty($request->icon_image)) {
                // icon_imageが設定されている場合の処理
                // public/iconに$fileNameToStoreという名前で画像を保存
                $fileName = uniqid(rand().'_');
                $extention = $request->file('icon_image')->extension();
                $fileNameToStore = $fileName.'.'.$extention;
                $request->file('icon_image')->storeAs('public/icon', $fileNameToStore);
            }
            DB::transaction(function () use($request, $fileNameToStore) {
                $user = User::find(Auth::id());
                // usersテーブルを変更(表示名、アイコン画像)
                User::where('id', Auth::id())->update([
                    'nickname' => $request->nickname,
                    'icon_image' => $fileNameToStore,
                ]);
                // engineersテーブルを変更(年齢、性別、自己紹介、github、facebook、qiita)
                Engineer::where('user_id', Auth::id())->update([
                    'age' => $request->age,
                    'gender' => $request->gender,
                    'introduction' => $request->introduction,
                    'github_url' => $request->github_url,
                    'facebook_url' => $request->facebook_url,
                    'qiita_url' => $request->qiita_url,
                ]);
                // 中間テーブルを変更
                $user->jobs()->sync($request->job_ids);
                $user->tags()->sync($request->tag_ids);
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
