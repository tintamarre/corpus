<?php

namespace App\Http\Controllers\Collection;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSegment;
use App\Models\Collection;
use App\Models\Segment;
use App\Models\Text;
use App\Traits\ReplaceTagTrait;
use Illuminate\Http\Request;

class CollectionSegmentsController extends Controller
{
    use ReplaceTagTrait;

    public function update(Collection $collection, Text $text, Segment $segment, UpdateSegment $request)
    {
        $result = $this->replaceTags($segment, $request);

        $segment->content = $request->input('text');
        $segment->save();

        flash(__('app.flash_updated', ['what' => ucfirst(__('app.segment'))]));
        
        return redirect()->route('collection.texts.show', [$collection, $text]);
    }

    public function store(Collection $collection, Text $text, Request $request)
    {
        if (isset($request->position)) {
            $position = $request->position;
        } else {
            $position = 0;
        }

        foreach (explode("###-insert-new-segment-###", $request->text) as $value) {
            // $content = preg_replace("/\r/", "", $value);
            // $content = preg_replace('/(?:(?:\r\n|\r|\n)\s*){2}/s', "\n\n", $content)
            // \r = CR (Carriage Return) → Used as a new line character in Mac OS before X
            // \n = LF (Line Feed) → Used as a new line character in Unix/Mac OS X
            // \r\n = CR + LF → Used as a new line character in Windows
            $content = preg_replace("/[\r\n]+/", "\n", $value);

            if ($content != '') {
                $text->segments()->create([

          'content' => $content,
          'position' => $position,
        ]);
                $position++;
            }
        }

        flash(__('app.flash_created', ['what' => __('app.text')]));

        return redirect()->route('collection.texts.show', [$collection, $text]);
    }
}
