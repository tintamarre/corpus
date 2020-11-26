<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PortfolioResource extends JsonResource
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
        'type'          => 'collections',
        'id'            => $this->id,
        'slug'            => (string)$this->slug,
        'name' => (string)mb_strimwidth($this->name, 0, 45, "..."),
        'description' => (string)mb_strimwidth($this->description, 0, 144, "..."),
        'role' => $this->pivot->role,
        'count_texts' => (int)$this->texts->count(),
        'count_tags' => (int)$this->tags->count(),
        'count_labels' => (int)$this->labels->count(),
        'count_users' => (int)$this->users->count(),
        'datetimes' => $this->datetimes,
        // 'relationships' => new CollectionRelationshipResource($this),
        'links'         => [
          'self' => route('collection.show', [$this->slug]),
          'api_update' => '',
        ],
      ];
      // return parent::toArray($request);
    }
    }
}
