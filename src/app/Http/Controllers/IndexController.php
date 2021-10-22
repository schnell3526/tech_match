<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job;
use App\Models\Tag;
use App\Models\Engineer;
use App\Http\Requests\Search;
use Illuminate\Support\Facades\Auth;

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
            $user = User::find($engineer->user_id);
            $user_id = $user->id;
            $nickname = $user->nickname;
            $icon_img = $user->icon_image;
            
            $jobs = $user->jobs()->get();
            $tags = $user->tags()->get();
            
            $age = $engineer->age;
            $gender = $engineer->gender;

            $products = $user->products()->get();
            $images = array();
            foreach($products as $product)
            {
                array_push($images, $product->product_images()->first()->image_path);
            }
            array_push($usersdata, array('user_id' => $user_id, 'nickname' => $nickname, 'icon_img' => $icon_img,
                                            'jobs' => $jobs, 'tags' => $tags, 'age' => $age, 'gender' => $gender,
                                         'images' => $images));

        }
        $auth = Auth::user();

        return view('index', [
            'error2' => "",
            'usersdata' => $usersdata,
            'words' => "",
            'andor' => "",
            
            
        ]);

    }

    public function search(Search $request)
    {
        $searchword = $request->searchword;
        $andor = $request->andor;
        $words = double_explode("　", " ", $searchword);
        $tmp = $words;
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
                    'words' => $words,
                    'andor' => $andor,
                ]);
            }
            $words[0] = mb_strtolower($words[0]);

            foreach($engineers as $engineer)
            {
                $user = User::find($engineer->user_id);
                $identity = $engineer->introduction;
                $tags = $user->tags()->get();
                foreach($tags as $tag)
                {
                    $identity .= $tag->name;
                }
                $jobs = $user->jobs()->get();
                foreach($jobs as $job)
                {
                    $identity .= $job->name;
                }
                $identity = mb_strtolower($identity);
                if(strpos($identity, $words[0]) !== false)
                {
                    $user_id = $user->id;
                    $nickname = $user->nickname;
                    $icon_img = $user->icon_image;
                    $age = $engineer->age;
                    $gender = $engineer->gender;
                    $products = $user->products()->get();
                    $images = array();
                    foreach($products as $product)
                    {
                        $images = $images + $product->product_images()->first()->image_path;
                    }
                    
                    array_push($results, array('user_id' => $user_id, 'nickname' => $nickname, 'icon_img' => $icon_img,
                                            'jobs' => $jobs, 'tags' => $tags, 'age' => $age, 'gender' => $gender,
                                            'images' => $images));
                }
            }
            $words = $tmp;

            return view('index', [
                'error2' => "",
                'usersdata' => $results,
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
                    'error2' => '1つのキーワードで検索するには「1つで検索」を選択してください．',
                    'words' => $words,
                    'andor' => $andor,
                ]);
            }
            
            foreach($engineers as $engineer)
            {
                $user = User::find($engineer->user_id);
                $identity = $engineer->introduction;
                $tags = $user->tags()->get();
                foreach($tags as $tag)
                {
                    $identity .= $tag->name;
                }
                $jobs = $user->jobs()->get();
                foreach($jobs as $job)
                {
                    $identity .= $job->name;
                }
                $identity = mb_strtolower($identity);
                $i = 0;
                foreach($words as $word)
                {
                    $word = mb_strtolower($word);
                    if(strpos($identity, $word) === false)
                    {
                        break;
                    }
                    $i += 1;
                    if($i == count($words))
                    {
                        $user_id = $user->id;
                        $nickname = $user->nickname;
                        $icon_img = $user->icon_image;
                        $age = $engineer->age;
                        $gender = $engineer->gender;
                        $products = $user->products()->get();
                        $images = array();
                        foreach($products as $product)
                        {
                            $images = $images + $product->product_images()->first()->image_path;
                        }
                        
                        array_push($results, array('user_id' => $user_id, 'nickname' => $nickname, 'icon_img' => $icon_img,
                                                'jobs' => $jobs, 'tags' => $tags, 'age' => $age, 'gender' => $gender,
                                                'images' => $images));
                    }
                }
            }

            $words = $tmp;

            return view('index', [
                'error2' => "",
                'usersdata' => $results,
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
                    'error2' => '1つのキーワードで検索するには「1つで検索」を選択してください．',
                    'words' => $words,
                    'andor' => $andor,
                ]);
            }
            
            foreach($engineers as $engineer)
            {
                $user = User::find($engineer->user_id);
                $identity = $engineer->introduction;
                $tags = $user->tags()->get();
                foreach($tags as $tag)
                {
                    $identity .= $tag->name;
                }
                $jobs = $user->jobs()->get();
                foreach($jobs as $job)
                {
                    $identity .= $job->name;
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
                        $age = $engineer->age;
                        $gender = $engineer->gender;
                        $products = $user->products()->get();
                        $images = array();
                        foreach($products as $product)
                        {
                            $images = $images + $product->product_images()->first()->image_path;
                        }
                        
                        array_push($results, array('user_id' => $user_id, 'nickname' => $nickname, 'icon_img' => $icon_img,
                                                'jobs' => $jobs, 'tags' => $tags, 'age' => $age, 'gender' => $gender,
                                                'images' => $images));
                        break;
                    }
                    
                }
            }
            $words = $tmp;

            return view('index', [
                'error2' => "",
                'usersdata' => $results,
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

