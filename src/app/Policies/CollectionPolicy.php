<?php

namespace App\Policies;

use App\Models\Collection;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CollectionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the collection.
     *
     * @param  App\Models\Collection  $collection
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(Collection $collection, User $user)
    {
        // return false;
        // !in_array($collection->id, $user->collections()->pluck('collections.id')->toArray()));
    }
}
