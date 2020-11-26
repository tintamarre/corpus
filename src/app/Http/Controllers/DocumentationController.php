<?php

namespace App\Http\Controllers;

class DocumentationController extends Controller
{
    /**
     * Show the application documentation
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('documentation.index');
    }
}
