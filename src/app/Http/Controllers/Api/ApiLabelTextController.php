<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LabelTextResource;
use App\Models\Collection;
use App\Models\Label;
use App\Models\LabelText;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiLabelTextController extends Controller
{
    public function __construct()
    {
    }

    public function update(Collection $collection, LabelText $label_text, Request $request)
    {
        $label_text->fill($request->input())->save();

        $label_text = new LabelTextResource($label_text);

        return response($label_text, Response::HTTP_OK);
    }

    public function destroy(Collection $collection, LabelText $label_text, Request $request)
    {
        LabelText::find($label_text->id)->delete();

        $this->deleteLabelWithoutAttribute($collection, $label_text);

        return response(null, Response::HTTP_OK);
    }

    private function deleteLabelWithoutAttribute($collection, $label_text)
    {
        $label = Label::whereCollectionId($collection->id)->find($label_text->label_id);
        if ($label->label_texts->count() == 0) {
            $label->delete();
        }
    }
}
