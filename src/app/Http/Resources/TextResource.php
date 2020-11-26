<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TextResource extends JsonResource
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
      'id'            => $this->id,
      'slug'            => (string)$this->slug,
      'name'             => (string)$this->name,
      'abstract' => (string)$this->abstract,
      'collection' =>  new CollectionResource($this->collection),
      'relationships' => new TextRelationshipResource($this),
      'datetimes' => $this->datetimes,
      'links'         => [
        'self' => route('collection.texts.show', [$this->collection, $this]),
        'api_self' => route('api.collection.texts.show', [$this->collection,
        $this, ]),
        'api_update' => route('api.collection.texts.update', [$this->collection,
        $this, ]),
        'api_destroy' => route('api.collection.texts.destroy', [$this->collection, $this]),
        'api_label_store' => route('api.collection.texts.labels.store', [$this->collection, $this]),
        'api_tag_store' => route('api.collection.texts.tags.store', [$this->collection, $this]),
        'store_segment' => route('collection.texts.segments.store', [$this->collection, $this]),

      ],
    ];
    }
}
