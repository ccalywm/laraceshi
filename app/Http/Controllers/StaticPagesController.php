<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    public function index()
    {
        return view('shares.index');
    }

    public function about()
    {
        return view('shares.about');
    }

    public function help()
    {
        return view('shares.help');
    }
}
