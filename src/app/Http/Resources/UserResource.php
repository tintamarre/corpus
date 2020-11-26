<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
    * Transform the resource into an array.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return array
    */
    public function toArray($request)
    {
        $collection = \App\Models\Collection::findOrFail($this->pivot->collection_id);

        return [
      'type'          => 'users',
      'id'            => (int)$this->id,
      'name'          => (string)$this->name,
      'email'          => (string)$this->email,
      'role'          => (string)$this->pivot->role,
      'member_since'  => (string)$this->pivot->created_at->diffForHumans(['parts' => 2]),
      'collection_id' => (int)$this->pivot->collection_id,
      'is_auth'       => (boolean)$this->is_auth,
      'links'         => [
        'self' => '',
        'api_update' => route('api.collection.users.update', [$collection, $this]),
        'api_detach' => route('api.collection.users.detach', [$collection, $this]),
        'api_store' => route('api.collection.users.store', [$collection]),
      ],
      'datetimes' => $this->datetimes,
    ];
    }
    public function with($request)
    {
        return [

    ];
    }
}
