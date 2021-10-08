<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MypageController extends Controller
{
    
    public function __construct()
    {

    }

    public function index(Request $request)
    {
        return view('users.index');
    }

    public function create()
    {
        $me = User::get();
        return view('users.create', compact('me'));
    }
}
