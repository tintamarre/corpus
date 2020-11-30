<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Models\Collection;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiTagController extends Controller
{
    public function __construct()
    {
    }

    public function index(Collection $collection)
    {
        $collection = Collection::findOrFail($collection_id);

        $tags = $collection->tags()
        ->orderBy('created_at', 'desc')
        ->with('label_tag')
        ->get();

        return TagResource::collection($tags);
    }

    public function show(Collection $collection, Tag $tag)
    {
        $tag->load('segments');

        return new TagResource($tag);
    }

    public function update(Collection $collection, Tag $tag, Request $request)
    {
        $tag->fill($request->all());
        $tag->save();

        return response(null, Response::HTTP_OK);
    }
}