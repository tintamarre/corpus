<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LabelTextResource;
use App\Models\Collection;
use App\Models\Text;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiTextLabelController extends Controller
{
    public function __construct()
    {
    }

    public function store(Collection $collection, Text $text, Request $request)
    {
        $label = $collection->labels()->firstOrCreate([
      'name' => $request->name,
      'format' => $request->format,
      'collection_id' => $collection->id,
    ]);

        $label_text = $label->label_texts()->firstOrCreate(
            [
        'attribute' => $request->attribute,
        'text_id' => $text->id,
        'label_id' => $label->id,
      ]
        );

        $label_texts = LabelTextResource::collection($text->label_texts);

        return response($label_texts, Response::HTTP_OK);
    }
}
