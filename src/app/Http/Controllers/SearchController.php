<?php

namespace App\Http\Controllers;

use Auth;

class SearchController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
    }

    public function show($query)
    {
        $user = Auth::user();

        return view('search.show', compact('user', 'query'));
    }
}
