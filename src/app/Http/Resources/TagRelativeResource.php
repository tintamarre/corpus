<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagRelativeResource extends JsonResource
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
      'description' => (string)$this->description,
      'color' => (string)$this->color ? $this->color : '#428BCA' ,
      'datetimes' => $this->datetimes,
      'snippets' => $this->snippets,
      'links'         => [
        'self' => route('collection.tags.show', [$this->collection, $this]),
        'api_update' => route('api.collection.tags.update', [$this->collection, $this]),
        'api_resources_parent_tags' => route('api.collection.resources.parent_tags', [$this->collection, $this]),

      ],
    ];
        // return parent::toArray($request);
    }
}
