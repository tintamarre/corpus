<?php

namespace App\Http\Controllers\Collection;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Tag;

class CollectionTagsController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct(

    ) {
    }

    /**
    * Show the view for a Collection.
    *
    * @return Response
    */
    public function show(Collection $collection, Tag $tag)
    {
        return view('collection.tags.show', compact('collection', 'tag'));
    }
}
