<?php

namespace App\Models;

class CollectionUser extends BaseModel
{
    protected $table = 'collection_user';

    /**
    * Get the CollectionUser that owns the text.
    */
    public function collection()
    {
        return $this->belongsTo('App\Models\Collection');
    }

    /**
    * Get the CollectionUser that owns the text.
    */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
