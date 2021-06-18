<?php

namespace App\Http\Controllers\Collection;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateText;
use App\Models\Collection;
use App\Models\Text;
use Auth;

class CollectionTextsController extends Controller
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
    * Show the view for a Text
    */
    public function show(Collection $collection, Text $text)
    {
        return view('collection.texts.show', compact('collection', 'text'));
    }

    public function create(Collection $collection)
    {
        return view('collection.texts.create', compact('collection'));
    }

    public function store(Collection $collection, CreateText $request)
    {
        $text = $collection->texts()->create($request->all());
        $text->uploader_id = Auth::id();
        $text->save();

        flash(__('app.flash_created', ['what' => __('app.text')]));

        return redirect()->route('collection.texts.show', [$collection, $text]);
    }
}
