<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LabelResource extends JsonResource
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
      'type'          => 'labels',
      'id'            => (int)$this->id,
      'name'          => (string)$this->name,
      'label_texts_count' => (int)$this->label_texts_count,
      'description'   => (string)$this->description,
      'attributes'    => $this->label_texts,
      'attributes_grouped' => $this->label_texts,
      'datetimes'     => $this->datetimes,
      'links'         => [
        'self' => route('collection.labels.show', [$this->collection, $this]),
        'api_update' => '',
      ],
    ];
    }
    public function with($request)
    {
        return [

    ];
    }
}
