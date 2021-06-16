<?php

namespace App\Http\Controllers;

class LandingController extends Controller
{
    /**
     * Show the application landing page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function landing()
    {
        return view('landing.landing');
    }
}
