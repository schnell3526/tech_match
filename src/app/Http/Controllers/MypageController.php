<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Engineer;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MypageRequest;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

use App\Models\Job;
use App\Models\Tag;

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
            $product_id = "'" . $product->id . "'";
            $products_image = array_merge($products_image, array($product_id => $image->image_path));
        }

        $chat_users_id = array();
        $new_message_users_id = array();
        $messages = Message::where('receive_user_id', $id)->where('checked', 0)->get();
        foreach($messages as $message)
        {
            $send_user = $message->send_user_id;
            if(!in_array($send_user, $new_message_users_id))
            {
                array_push($new_message_users_id, $send_user);
            }
        }
        $messages = Message::where('receive_user_id', $id)->where('checked', 1)->get();
        foreach($messages as $message)
        {
            $send_user = $message->send_user_id;
            if((!in_array($send_user, $chat_users_id)) and (!in_array($send_user, $new_message_users_id)))
            {
                array_push($chat_users_id, $send_user);
            }
        }
        $messages = Message::where('send_user_id', $id)->get();
        foreach($messages as $message)
        {
            $receive_user = $message->receive_user_id;
            if((!in_array($receive_user, $chat_users_id)) and (!in_array($receive_user, $new_message_users_id)))
            {
                array_push($chat_users_id, $receive_user);
            }
        }
        $new_message_users = array();
        foreach($new_message_users_id as $new_message_user_id)
        {
            $new_message_user = User::find($new_message_user_id);
            array_push($new_message_users, $new_message_user);
        }
        $chat_users = array();

        foreach($chat_users_id as $chat_user_id)
        {
            $chat_user = User::find($chat_user_id);
            array_push($chat_users, $chat_user);
        }

        if($new_message_users_id)
        {
            $new_message = true;
        }
        else
        {
            $new_message = false;
        }





        return view('userpage', [
            'user' => $user,
            'engineer' => $engineer,
            'products' => $products,
            'tags' => $tags,
            'jobs' => $jobs,
            'products_image' => $products_image,
            'mypage' => true,
            'new_message_users' => $new_message_users,
            'chat_users' => $chat_users,
            'new_message' => $new_message,

        ]);

    }

    // ??????????????????????????????????????????????????????
    public function create()
    {
        if (!Auth::check()) {
            // ??????????????????????????????????????????????????????
            return redirect("/login");
        }

        // id??????????????????????????????
        $id = Auth::id();
        $user = User::find($id);
        
        if($user->engineer()->first())
        {

            return redirect(route('mypage.edit', ['id' => $id]));

        }

        // ?????????????????????????????????
        $all_jobs = Job::all();
        $all_tags = Tag::all();

        return view('users.create', compact(['all_jobs', 'all_tags']));
    }

    // ????????????????????????????????????
    public function store(MypageRequest $request)
    {
        try{
            if(!empty($request->icon_image)) {
                // icon_image???????????????????????????????????????
                // public/icon???$fileNameToStore?????????????????????????????????
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

                User::where('id', Auth::id())->update([
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

                // job_user?????????????????????
                $user->jobs()->sync($request->job_ids);
                // tag_user?????????????????????
                $user->tags()->sync($request->tag_ids);
            }, 2);
        }catch(Exception $e) {
            Log::error($e);
            throw $e;
        }
        return redirect()->route('mypage.index');
    }

    // ?????????????????????
    public function edit($id)
    {
        // DB?????????????????????????????????????????????
        // https://readouble.com/laravel/8.x/ja/database.html?#database-transactions
        // ???????????????????????????
        $mypage = User::with(['engineer', 'jobs', 'tags'])->find($id);
        // ??????????????????
        $all_jobs = Job::all();
        // ??????????????????
        $all_tags = Tag::all();

        // ?????????????????????????????????????????????
        $my_jobs = array();
        foreach ($mypage->jobs as $job){
            $my_jobs[] = $job->name;
        }

        // ?????????????????????????????????????????????
        $my_tags = array();
        foreach ($mypage->tags as $tag){
            $my_tags[] = $tag->name;
        }

        // compact()???view????????????????????????
        return view('users.edit', compact('mypage', 'all_jobs', 'my_jobs', 'all_tags', 'my_tags'));
    }

    // users??????engineers?????????????????????
    public function update(Request $request)
    {
        try {
            if(!empty($request->icon_image)) {
                // icon_image???????????????????????????????????????
                // public/icon???$fileNameToStore?????????????????????????????????
                $fileName = uniqid(rand().'_');
                $extention = $request->file('icon_image')->extension();
                $fileNameToStore = $fileName.'.'.$extention;
                $request->file('icon_image')->storeAs('public/icon', $fileNameToStore);
            }
            DB::transaction(function () use($request, $fileNameToStore) {
                $user = User::find(Auth::id());
                // users?????????????????????(??????????????????????????????)
                User::where('id', Auth::id())->update([
                    'nickname' => $request->nickname,
                    'icon_image' => $fileNameToStore,
                ]);
                // engineers?????????????????????(?????????????????????????????????github???facebook???qiita)
                Engineer::where('user_id', Auth::id())->update([
                    'age' => $request->age,
                    'gender' => $request->gender,
                    'introduction' => $request->introduction,
                    'github_url' => $request->github_url,
                    'facebook_url' => $request->facebook_url,
                    'qiita_url' => $request->qiita_url,
                ]);
                // ???????????????????????????
                $user->jobs()->sync($request->job_ids);
                $user->tags()->sync($request->tag_ids);
            }, 2);
        } catch(Exception $e) {
            // DB??????????????????????????????
            Log::error($e);
            throw $e;
        }
        // ????????????????????????????????????
        return redirect()->route('mypage.index');
    }
}
