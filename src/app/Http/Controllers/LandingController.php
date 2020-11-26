<?php

namespace App\Http\Controllers;

class LandingController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function landing()
    {
        return view('landing.landing');
    }
}
