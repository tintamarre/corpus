<?php

namespace App\Http\Controllers;

use Auth;

class HomeController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
    }

    public function portfolio()
    {
        $user = Auth::user();

        return view('home.portfolio', compact('user'));
    }

    public function announcement()
    {
        $user = Auth::user();

        return view('home.announcement', compact('user'));
    }
}
