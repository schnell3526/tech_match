<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job;
use App\Models\Tag;
use App\Models\Engineer;
use App\Models\Users_tag;
use App\Models\Users_job;
use App\Http\Requests\Search;
use Auth;

function double_explode($word1, $word2, $str) {
    $return = array();

    //分割文字その1で文字列を分割
    $array = explode($word1, $str);

    //各配列を分割文字その2で分割して結合していく
    foreach ($array as $value) {
        $return = array_merge($return, explode($word2, $value));
    }
    return $return;
}



class IndexController extends Controller
{
    public function index()
    {
        $engineers = Engineer::all();
        $usersdata = array();
        
        

        #userごとに[nickname, icon_img, job_name(複数あるので配列), [tag_name, tag_color](複数あるので配列)]という配列を定義
        foreach($engineers as $engineer)
        {
            $user = User::find($engineer->id);
            $user_id = $user->id;
            $nickname = $user->nickname;
            $icon_img = $user->icon_image;
            
            $users_jobs = $user->users_jobs()->get();
            $jobs = array();
            foreach($users_jobs as $user_job)
            {
                $job_id = $user_job->job_id;
                $job = Job::find($job_id);
                array_push($jobs, $job->job_name);
            }
            $users_tags = $user->users_tags()->get();
            $tags = array();
            foreach($users_tags as $user_tag)
            {
                $tag_id = $user_tag->tag_id;
                $tag = Tag::find($tag_id);
                array_push($tags, array('tag_name' => $tag->tag_name, 'color' => $tag->color));
            }
            
            
            $age = $engineer->age;
            $gender = $engineer->gender;
            array_push($usersdata, array('user_id' => $user_id, 'nickname' => $nickname, 'icon_img' => $icon_img,
                                            'jobs' => $jobs, 'tags' => $tags, 'age' => $age, 'gender' => $gender));

        }
        $auth = Auth::user();

        return view('index', [
            'error2' => "",
            'usersdata' => $usersdata,
            'loginuser' => $auth,
            
        ]);

    }

    public function search(Search $request)
    {
        $searchword = $request->searchword;
        $andor = $request->andor;
        $words = double_explode("　", " ", $searchword);
        #検索にヒットしたユーザ情報をlistで返す
        $results = array();
        $engineers = Engineer::all();
        $auth = Auth::user();
        if($andor == '1つで検索')
        {
            
            if(count($words) != 1)
            {
                return view('index', [
                    'error2' => '複数キーワードはandかorを指定してください．',
                    'usersdata' => '',
                    'loginuser' => $auth,
                ]);
            }
            $words[0] = mb_strtolower($words[0]);

            foreach($engineers as $engineer)
            {
                $user = User::find($engineer->user_id);
                $identity = $engineer->introduction;
                $user_tags = $user->users_tags()->get();
                foreach($user_tags as $user_tag)
                {
                    $tag_id = $user_tag->tag_id;
                    $tag = Tag::find($tag_id);
                    $identity .= $tag->tag_name;
                }
                $user_jobs = $user->users_jobs()->get();
                foreach($user_jobs as $user_job)
                {
                    $job_id = $user_job->job_id;
                    $job = Job::find($job_id);
                    $identity .= $job->job_name;
                }
                $identity = mb_strtolower($identity);
                if(strpos($identity, $words[0]) !== false)
                {
                    $user_id = $user->id;
                    $nickname = $user->nickname;
                    $icon_img = $user->icon_image;
                    $jobs = array();
                    foreach($user_jobs as $user_job)
                    {
                        $job = Job::find($user_job->job_id);
                        array_push($jobs, $job->job_name);

                    }
                    $tags = array();
                    foreach($user_tags as $user_tag)
                    {
                        $tag = Tag::find($user_tag->tag_id);
                        array_push($tags, array('color' => $tag->color, 'tag_name' => $tag->tag_name));
                    }
                    $age = $engineer->age;
                    $gender = $engineer->gender;
                    
                    array_push($results, array('user_id' => $user_id, 'nickname' => $nickname, 'icon_img' => $icon_img,
                                            'jobs' => $jobs, 'tags' => $tags, 'age' => $age, 'gender' => $gender));
                    
                }
            }

            return view('searchresult', [
                'results' => $results,
                'words' => $words,
                'andor' => $andor,
            ]);
        }

        elseif($andor == 'and')
        {
            if(count($words) <= 1)
            {
                return view('index', [
                    'usersdata' => '',
                    'loginuser' => $auth,
                    'error2' => '1つのキーワードで検索するには「1つで検索」を選択してください．',
                ]);
            }
            
            foreach($engineers as $engineer)
            {
                $user = User::find($engineer->user_id);
                $identity = $engineer->introduction;
                $user_tags = $user->users_tags()->get();
                foreach($user_tags as $user_tag)
                {
                    $tag_id = $user_tag->tag_id;
                    $tag = Tag::find($tag_id);
                    $identity .= $tag->tag_name;
                }
                $user_jobs = $user->users_jobs()->get();
                foreach($user_jobs as $user_job)
                {
                    $job_id = $user_job->job_id;
                    $job = Job::find($job_id);
                    $identity .= $job->job_name;
                }
                $identity = mb_strtolower($identity);
                foreach($words as $word)
                {
                    $word = mb_strtolower($word);
                    if(strpos($identity, $word) === false)
                    {
                        break;
                    }
                    if($word == $words[count($words) - 1])
                    {
                        $user_id = $user->id;
                        $nickname = $user->nickname;
                        $icon_img = $user->icon_image;
                        $jobs = array();
                        foreach($user_jobs as $user_job)
                        {
                            $job = Job::find($user_job->job_id);
                            array_push($jobs, $job->job_name);
                        }
                        $tags = array();
                        foreach($user_tags as $user_tag)
                        {
                            $tag = Tag::find($user_tag->tag_id);
                            array_push($tags, array('color' => $tag->color, 'tag_name' => $tag->tag_name));
                        }
                        $age = $engineer->age;
                        $gender = $engineer->gender;
                        
                        array_push($results, array('user_id' => $user_id, 'nickname' => $nickname, 'icon_img' => $icon_img,
                                                'jobs' => $jobs, 'tags' => $tags, 'age' => $age, 'gender' => $gender));
                    }
                }
            }

            return view('searchresult', [
                'results' => $results,
                'words' => $words,
                'andor' => $andor,
            ]);
        }

        else
        {
            if(count($words) <= 1)
            {
                return view('index', [
                    'usersdata' => '',
                    'loginuser' => $auth,
                    'error2' => '1つのキーワードで検索するには「1つで検索」を選択してください．',
                ]);
            }
            
            foreach($engineers as $engineer)
            {
                $user = User::find($engineer->user_id);
                $identity = $engineer->introduction;
                $user_tags = $user->users_tags()->get();
                foreach($user_tags as $user_tag)
                {
                    $tag_id = $user_tag->tag_id;
                    $tag = Tag::find($tag_id);
                    $identity .= $tag->tag_name;
                }
                $user_jobs = $user->users_jobs()->get();
                foreach($user_jobs as $user_job)
                {
                    $job_id = $user_job->job_id;
                    $job = Job::find($job_id);
                    $identity .= $job->job_name;
                }
                $identity = mb_strtolower($identity);
                foreach($words as $word)
                {
                    $word = mb_strtolower($word);
                    if(strpos($identity, $word) !== false)
                    {
                        $user_id = $user->id;
                        $nickname = $user->nickname;
                        $icon_img = $user->icon_image;
                        $jobs = array();
                        foreach($user_jobs as $user_job)
                        {
                            $job = Job::find($user_job->job_id);
                            array_push($jobs, $job->job_name);

                        }
                        $tags = array();
                        foreach($user_tags as $user_tag)
                        {
                            $tag = Tag::find($user_tag->tag_id);
                            array_push($tags, array('color' => $tag->color, 'tag_name' => $tag->tag_name));
                        }
                        $age = $engineer->age;
                        $gender = $engineer->gender;
                        
                        array_push($results, array('user_id' => $user_id, 'nickname' => $nickname, 'icon_img' => $icon_img,
                                                'jobs' => $jobs, 'tags' => $tags, 'age' => $age, 'gender' => $gender));
                        break;
                    }
                    
                }
            }

            return view('searchresult', [
                'results' => $results,
                'words' => $words,
                'andor' => $andor,
            ]);
        }

    }


    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

}

