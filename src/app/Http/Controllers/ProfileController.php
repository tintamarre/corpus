<?php

namespace App\Http\Controllers;

use Auth;

class ProfileController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
    }

    public function show()
    {
        $user = Auth::user();

        return view('profile.show', compact('user'));
    }
}
