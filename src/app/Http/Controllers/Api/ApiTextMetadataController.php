<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LabelTextResource;
use App\Models\Collection;
use App\Models\Text;
use Illuminate\Http\Response;

class ApiTextMetadataController extends Controller
{
    public function __construct()
    {
    }

    public function tags(Collection $collection, Text $text)
    {
        return response()->json([
      'data' => $text->tagscloud,
    ]);
    }

    public function stats(Collection $collection, Text $text)
    {
        return response()->json([
      'data' => $text->stats,
    ]);
    }

    public function labels(Collection $collection, Text $text)
    {
        return LabelTextResource::collection($text->label_texts);
    }
}
