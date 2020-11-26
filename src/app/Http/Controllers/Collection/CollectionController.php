<?php

namespace App\Http\Controllers\Collection;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCollection;
use App\Http\Requests\UpdateCollection;
use App\Models\Collection;
use Auth;

class CollectionController extends Controller
{
    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct(
        Collection $collection
    ) {
        $this->collection = $collection;
    }

    /**
    * Show the view for a Collection.
    *
    * @return Response
    */
    public function show(Collection $collection)
    {
        return view('collection.show', compact('collection'));
    }
    public function create()
    {
        return view('collection.create');
    }
    public function store(CreateCollection $request)
    {
        $collection = $this->collection->create($request->only(['name', 'description']));

        Auth::user()->collections()->attach($collection->id, ['role' => 'admin']);

        flash(__('app.flash_created', ['what' => __('app.collection')]));

        return redirect()->route('portfolio');
    }
    public function edit(Collection $collection)
    {
        return view('collection.edit', compact('collection'));
    }

    public function update(Collection $collection, UpdateCollection $request)
    {
        $collection->fill($request->only(['name', 'description']))->save();

        flash(__('app.flash_updated', ['what' => __('app.collection')]));

        return redirect()->route('collection.show', [$collection->slug]);
    }
}
