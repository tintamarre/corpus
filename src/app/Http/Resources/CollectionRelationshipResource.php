<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CollectionRelationshipResource extends JsonResource
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
      'stats' => [
        'data' => $this->stats,
      ],
      'tagscloud' => [
        'data' => $this->tagscloud,
      ],
      'users'   => [
        'data' => UserResource::collection($this->whenLoaded('users')),
      ],

      // 'texts' => [
      //   'data' => TextResource::collection($this->whenLoaded('texts')),
      // ],
      'labels' => [
        'data' => LabelResource::collection($this->whenLoaded('labels')),
      ],
    ];
    }
    public function with($request)
    {
        return [
      'links' => [
        'self' => route('collection.show'),
      ],
    ];
    }
}
