<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SnippetResource extends JsonResource
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
        'type'          => 'segment_tag',
        'id'            => (int)$this->id,
        'segment_tag_id' => (int)$this->id,
        'author' => \App\User::find($this->user_id)->name,
        'snippet_start' => (int)$this->snippet_start,
        'snippet_end' => (int)$this->snippet_end,
        'snippet_length' => (int)$this->snippet_end - (int)$this->snippet_start,
        'links' => [
          'api_segment_tag_destroy' => route('api.collection.segment_tag.destroy', [$this->tag->collection, (int)$this->id]),
        ],
      ]

    }
