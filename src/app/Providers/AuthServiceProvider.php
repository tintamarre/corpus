<?php

namespace App\Providers;

use App\Models\Collection;
use App\Models\Text;
use App\User;
use Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
    * The policy mappings for the application.
    *
    * @var array
    */
    protected $policies = [
    // Example
    // 'App\Models\Collection' => 'App\Policies\CollectionPolicy',
  ];

    /**
    * Register any authentication / authorization services.
    *
    * @return void
    */
    public function boot()
    {
        // $this->registerPolicies();

        Gate::define('access-root', function (
            User $user
        ) {
            return $this->isRoot($user);
        });

        Gate::define('view-collection', function (
            User $user,
            Collection $collection
        ) {
            return $this->belongsToCollection($collection, $user);
        });

        Gate::define('detach-user', function (
            User $user,
            Collection $collection
        ) {
            if ($this->isAdmin($collection, $user)) {
                if ($this->notUniqueAdmin($collection)) {
                    return true;
                } elseif ($this->notOnlyMember($collection)) {
                    return true;
                }
            } else {
                return true;
            }
        });

        Gate::define('change-role', function (
            User $user,
            Collection $collection
        ) {
            return $this->isAdmin($collection, $user);
        });

        Gate::define('delete-collection', function (
            User $user,
            Collection $collection
        ) {
            return $this->isAdmin($collection, $user);
        });

        Gate::define('delete-text', function (
            User $user,
            Text $text
        ) {
            return $text->uploader_id == $user->id;
        });
    }

    #
    # private functions
    #
    private function belongsToCollection(Collection $collection, User $user)
    {
        return in_array($collection->id, $user->collections()->pluck('collections.id')->toArray());
    }

    private function isAdmin(Collection $collection, User $user)
    {
        return in_array($user->id, $collection->users()->whereRole('admin')->pluck('collection_user.user_id')->toArray());
    }

    private function notUniqueAdmin(Collection $collection)
    {
        return ($collection->users()->whereRole('admin')->get()->count() > 1);
    }

    private function isRoot(User $user)
    {
        return ($user->id == 1);
    }

    private function notOnlyMember(Collection $collection)
    {
        return ($collection->users()->get()->count() > 1);
    }
}
