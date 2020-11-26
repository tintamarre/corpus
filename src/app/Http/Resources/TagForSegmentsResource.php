<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagForSegmentsResource extends JsonResource
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
      'type'          => 'tags',
      'id'            => (int)$this->id,
      'name' => (string)$this->name,
      // 'description' => (string)$this->description,
      'color' => (string)$this->color ? $this->color : '#428BCA' ,
      'snippet' => $this->whenPivotLoaded(
          'segment_tag',
          function () {
              return [
            'author' => \App\User::find($this->pivot->user_id)->name,
            'snippet_start' => (int)$this->pivot->snippet_start,
            'snippet_end' => (int)$this->pivot->snippet_end,
            'segment_id' => (int)$this->pivot->segment_id,
            'segment_tag_id' => (int)$this->pivot->id,
            // 'top_offset' => (int)$this->top_offset,
            'links' => [
              'api_destroy' => route('api.collection.segment_tag.destroy', [$this->collection, $this->pivot]),
            ],
          ];
          }
      ),
      'datetimes' => $this->datetimes,
      'links'         => [
        'self' => route('collection.tags.show', [$this->collection, $this]),
        'api_update' => route('api.collection.tags.update', [$this->collection, $this]),
        'api_resources_parent_tags' => route('api.collection.resources.parent_tags', [$this->collection, $this]),
        'api_tag_graph' => route('api.collection.tag-graph.data', [$this->collection, $this]),

      ],
    ];
        // return parent::toArray($request);
    }
}
