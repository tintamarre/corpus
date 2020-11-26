<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LabelTextResource extends JsonResource
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
      'type'          => 'labels_texts',
      'id'            => $this->id,
      'label_id'      => $this->label->id,
      'name'          => (string)$this->label->name,
      'format'           => (string)$this->label->format,
      'default_description' => (string)$this->label->default_description,
      'attribute'       => $this->attribute,
      'datetimes' => $this->datetimes,
      'links'         => [
        'self' => route(
            'collection.labels.show',
            [$this->label->collection, $this->label->id]
        ),
        'api_update' => route(
            'api.collection.label_text.update',
            [$this->label->collection, $this->id]
        ),
        'api_destroy' => route(
            'api.collection.label_text.destroy',
            [$this->label->collection, $this->id]
        ),

        ],
      ];
    }
    public function with($request)
    {
        return [

      ];
    }
}
