<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('users.create');
    }
}
