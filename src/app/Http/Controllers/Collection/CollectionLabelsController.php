<?php

namespace App\Http\Controllers\Collection;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Label;

class CollectionLabelsController extends Controller
{
    public function __construct(
    ) {
    }

    /**
    * Show the view for a Collection.
    *
    * @return Response
    */
    public function show(Collection $collection, Label $label)
    {
        return view('collection.labels.show', compact('collection', 'label'));
    }
}
