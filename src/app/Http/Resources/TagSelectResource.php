<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TagSelectResource extends JsonResource
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
      'id'   => (int)$this->id,
      'name' => (string)$this->name,
      // 'segments_count' => $this->segments_count,
      // 'parents' => $this->parents,
      // 'children' => $this->children,
    ];

        // return parent::toArray($request);
    }
}
