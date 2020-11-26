<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\SegmentTag;
use App\Models\Tag;
use App\Models\Text;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiTextTagController extends Controller
{
    public function __construct()
    {
    }

    public function store(Collection $collection, Text $text, Request $request)
    {
        foreach ($request->tags as $request_tag) {
            $tag = Tag::firstOrCreate([
        'name' => $request_tag['name'],
        'collection_id' => $collection->id,
      ]);

            SegmentTag::create([
        'tag_id' => $tag->id,
        'segment_id' => $request->segment_id,
        'snippet_start' => $request->snippet_start,
        'snippet_end' => $request->snippet_end,
        'user_id' => Auth::id(),
        'text_id' => $text->id,
      ]);
        }

        return response(null, Response::HTTP_OK);
    }
}
