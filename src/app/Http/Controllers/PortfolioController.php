<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function store()
    {
        return redirect()->route('portfolio.index');
    }
}
