<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
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
      'name' => (string)$this->name,
      'description' => (string)$this->description,
      'color' => (string)$this->color ? $this->color : '#428BCA' ,
      'tagscloud' => [
        'data' => $this->tagscloud,
      ],
      'snippets' => $this->whenLoaded(
          'segments',
          function () {
              return json_decode($this->snippets);
          }
      ),
      'parent' => new TagRelativeResource($this->parent),
      // 'parents' => TagRelativeResource($this->parents),
      'children' => TagRelativeResource::collection($this->children),
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
