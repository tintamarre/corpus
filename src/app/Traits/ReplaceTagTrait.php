<?php

namespace App\Traits;

use App\Models\Segment;
use App\Models\SegmentTag;

trait ReplaceTagTrait
{
    protected function replaceTags(Segment $segment, $request)
    {
        $updated = 0;
        $deleted = 0;

        foreach ($segment->snippets as $snippet) {
            $result = $this->replaceTag($snippet, $request->input('text'));

            $updated = $updated + $result['updated'];
            $deleted = $deleted + $result['deleted'];
        }
        return response()->json([
            'updated' => $updated,
            'deleted' => $deleted
        ]);
    }
    
    protected function replaceTag($snippet, $text)
    {
        $segment_tag = SegmentTag::find($snippet['segment_tag_id']);
       
        $updated = 0;
        $deleted = 0;

        $needle = $snippet['snippet_content'];
        $offset = 0;
        $matches = [];
        
        // Finding occurences
        while (($offset = mb_strpos($text, $needle, $offset))!== false) {
            $matches[] = $offset;
            $offset = $offset + strlen($needle);
        }

        if (!empty($matches)) {
            $closest = $this->getClosest($snippet['snippet_start'], $matches);

            SegmentTag::create([
                    'segment_id' => $segment_tag->segment_id,
                    'text_id' => $segment_tag->text_id,
                    'tag_id' => $segment_tag->tag_id,
                    'snippet_start'=> $closest,
                    'snippet_end'=> $closest + $snippet['length'],
                    'user_id'=> $segment_tag->user_id
                ]);
            $updated = 1;
        } else {
            $deleted = 1;
        }
 
        $segment_tag->delete();

        return [
            'updated' => $updated,
            'deleted' => $deleted
        ];
    }

    protected function getClosest($search, $arr)
    {
        // find closest result from array of matches
        $closest = null;
        foreach ($arr as $item) {
            if ($closest === null || abs($search - $closest) > abs($item - $search)) {
                $closest = $item;
            }
        }
        return $closest;
    }
}
