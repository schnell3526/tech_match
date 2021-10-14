<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Engineer;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MypageRequest;

class MypageController extends Controller
{
    
    public function __construct()
    {

    }

    public function index()
    {
        return view('users.index');
    }

    public function create()
    {
        $me = User::get();
        return view('users.create', compact('me'));
    }

    public function store(MypageRequest $request)
    {
        try{
            $fileName = uniqid(rand().'_');
            $extention = $request->file('icon_image')->extension();
            $fileNameToStore = $fileName.'.'.$extention;
            $request->file('icon_image')->storeAs('/icon', $fileNameToStore);
            DB::transaction(function () use($request) {
                $user = User::create([
                    'name' => $request->name,
                    'icon_image' => $request->icon_image,
                    'nickname' => $request->nickname,
                    'email' => $request->email,
                    'password' => $request->password,
                ]);
                
                Engineer::create([
                    'user_id' => $user->id,
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

        return redirect()->route('users.index');
        
    }
    
}
