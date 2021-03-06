<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
      'type'          => 'users',
      'id'            => (int)$this->id,
      'name'          => (string)$this->name,
      'phone'          => (string)$this->phone,
      'country_code'   => (string)$this->country_code,
      'email'          => (string)$this->email,
      'links'         => [
        'self' => route('profile.show'),
        'api_update' => route('api.profile.update'),
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
