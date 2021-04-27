<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CollectionResource extends JsonResource
{
    /**
    * Transform the resource into an array.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return array
    */
    public function toArray($request)
    {
        {
      return [
        'type'          => (string)$this->type,
        'id'            => (int)$this->id,
        'slug'            => (string)$this->slug,
        'name' => (string)$this->name,
        'description' => (string)$this->description,
        'count_texts' => (int)$this->texts->count(),
        'count_tags' => (int)$this->tags->count(),
        'count_labels' => (int)$this->labels->count(),
        'count_users' => (int)$this->users->count(),
        'datetimes' => $this->datetimes,
        'relationships' => new CollectionRelationshipResource($this),
        'links'         => [
          'self' => route('collection.show', [$this]),
          // 'api_update' => route('api.collection.update', [$this]),
          'api_destroy' => route('api.collection.destroy', [$this]),
          'api_tag_store' => route('api.collection.tags.store', [$this]),
          'api_segment_tag_store' => route('api.collection.segment_tag.store', [$this]),
          'api_resources_labels' => route('api.collection.resources.labels', [$this]),
          'api_resources_tags' => route('api.collection.resources.tags', [$this]),
        ],
      ];
      // return parent::toArray($request);
    }
    }
}
