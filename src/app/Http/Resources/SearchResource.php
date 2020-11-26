<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SearchResource extends JsonResource
{
    protected static $using = null;

    public static function using($using)
    {
        static::$using = $using;
    }
    /**
    * Create a new resource instance.
    *
    * @param  mixed  $resource
    * @return void
    */

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
      'needle'        =>  (string)static::$using,
      'description'   =>  $this->resume,
      'links'         => [
        'url_name'    => $this->name ? $this->name : $this->text->name,
        'url_href'    => $this->link,
      ],
    ];
    }
    public function with($request)
    {
        return [

    ];
    }
}
