<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\SegmentTag;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiSegmentTagController extends Controller
{
    public function __construct()
    {
    }

    public function show(Collection $collection, SegmentTag $segment_tag)
    {
        $segment_tag->load('segments');

        return new SegmentTagResource($tag);
    }

    public function update(Collection $collection, SegmentTag $segment_tag, Request $request)
    {
        $segment_tag->fill($request->all());
        $segment_tag->save();

        return response(null, Response::HTTP_OK);
    }

    public function destroy(Collection $collection, SegmentTag $segment_tag, Request $request)
    {
        $tag_id = $segment_tag->tag_id;
        $segment_tag->delete();

        return response(null, Response::HTTP_OK);
    }
}
