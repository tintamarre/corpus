<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SegmentResource extends JsonResource
{
    /**
    * Transform the resource into an array.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return array
    */
    public function toArray($request)
    {
        return [
      'type'          => (string)$this->type,
      'id'            => (int)$this->id,
      'position'      => (int)$this->position,
      'content'       => (string)$this->content,
    //   'snippet'  => $this->whenPivotLoaded(
    //       'segment_tag',
    //       function () {
    //           return [
    //       'author' => \App\User::find($this->pivot->user_id)->name,
    //       'snippet_start' => (int)$this->pivot->snippet_start,
    //       'snippet_end' => (int)$this->pivot->snippet_end,
    //       'segment_tag_id' => (int)$this->pivot->id,
    //       // 'top_offset' => (int)$this->pivot->top_offset,
    //       'links' => [
    //         'api_segment_tag_destroy' => route('api.collection.segment_tag.destroy', [$this->text->collection, (int)$this->pivot->id]),
    //       ],
    //     ];
    //       }
    //   ),
    // 'snippets' => $this->whenLoaded(
    //     'tags',
    //     function () {
    //         return  json_decode($this->snippets);
    //     }
    // ),
    'tags' => TagForSegmentsResource::collection($this->whenLoaded('tags')),
    'datetimes' => $this->datetimes,
    'links'         => [
      'self' => route('collection.texts.show', [$this->text->collection, $this->text]),
      'update' => route('collection.texts.segments.update', [$this->text->collection, $this->text, $this]),
      'api_destroy' => route('api.collection.segments.destroy', [$this->text->collection, $this]),
    ],
  ];
    }
    public function with($request)
    {
        return [

  ];
    }
}
