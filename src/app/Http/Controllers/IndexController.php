<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job;
use App\Models\Tag;
use App\Models\Engineer;
use App\Http\Requests\Search;
use Auth;



class IndexController extends Controller
{
    public function index()
    {
        #エンジニアのidを配列で取得
        $engineers_id = array();
        $engineers = Engineer::all();
        foreach($engineers as $engineer)
        {
            array_push($engineers_id, $engineer->user_id);
        }
        #エンジニアのみを抽出
        $users = User::whereIn('id', $engineers_id)->get();
        $usersdata = array();

        #userごとに[nickname, icon_img, job_name(複数あるので配列), [tag_name, tag_color](複数あるので配列)]という配列を定義
        foreach($users as $user)
        {
            $user_id = $user->id;
            $nickname = $user->nickname;
            $icon_img = $user->icon_img;
            $jobs_id = $user->users_jobs()->get();
            $jobs = array();
            foreach($jobs_id as $job_id)
            {
                $job = Job::find($job_id);
                array_push($jobs, $job->job_name);
            }
            $tags_id = $user->users_tags()->get();
            $tags = array();
            foreach($tags_id as $tag_id)
            {
                $tag = Tag::find($tag_id);
                array_push($tags, array('tag_name' => $tag->tag_name, 'color' => $tag->color));
            }
            $engineer = Engineer::where('user_id', $user_id)->first();
            $age = $engineer->age;
            $usersdata = $usersdata + array('user_id' => $user_id, 'nickname' => $nickname, 'icon_img' => $icon_img,
                                            'jobs' => $jobs, 'tags' => $tags, 'age' => $age);

        }
        $auth = Auth::user();

        return view('index', [
            'usersdata' => $usersdata,
            'loginuser' => $auth,
            
        ]);

    }
    public function search(Search $request)
    {
        $searchword = $request->searchword;
        $andor = $request->andor;
        $words = explode("　", $searchword);
        $jobs = Job::all();
        $tags = Tag::all();
        $results = array();
        if($andor == '1つで検索')
        {
            if(count($words) != 1)
            {
                return view('index', [
                    'error2' => '複数キーワードはandかorを指定してください．'
                ]);
            }
        }
        else
        {
            return view('searchresult', [
                'word' => 'い',
            ]);
        }
    }


    public function logout()
    {
        return Auth::logout();
    }

}

