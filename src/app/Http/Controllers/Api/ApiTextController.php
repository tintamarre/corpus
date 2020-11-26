<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TextResource;
use App\Models\Collection;
use App\Models\Text;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiTextController extends Controller
{
    public function __construct()
    {
    }

    public function index(Collection $collection)
    {
        $texts = $collection->texts()
        ->orderBy('created_at', 'desc')
        ->with('label_texts')
        ->paginate(30);

        return TextResource::collection($texts);
    }

    public function show(Collection $collection, Text $text)
    {
        $text->load(['segments.tags', 'label_texts']);

        return new TextResource($text);
    }

    public function update(Collection $collection, Text $text, Request $request)
    {
        $text->update($request->only(['name', 'abstract']));

        return response($text, Response::HTTP_OK);
    }

    public function destroy(Collection $collection, Text $text)
    {
        if (Gate::allows('delete-text', $text)) {
            $text->delete();
        }

        return response(null, Response::HTTP_OK);
    }
}
