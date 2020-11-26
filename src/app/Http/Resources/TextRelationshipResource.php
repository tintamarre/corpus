<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TextRelationshipResource extends JsonResource
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
      'tagscloud' => $this->tagscloud,
      'stats' =>  $this->stats,
      'segments' => SegmentResource::collection($this->whenLoaded('segments')),
      'labels' => LabelTextResource::collection($this->whenLoaded('label_texts')),
      'uploader'   => [
        'id' => $this->uploader->id,
        'name' => $this->uploader->name,
        'is_auth' => (boolean)$this->uploader->is_auth,

      ],
      'stats' => $this->stats,
    ];
    }
    public function with($request)
    {
        return [
      'links' => [
        'self' => route('collection.texts.show', [$this->collection, $this]),
      ],
    ];
    }
}
