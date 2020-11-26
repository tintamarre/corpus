<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
    * The event listener mappings for the application.
    *
    * @var array
    */
    protected $listen = [
    Registered::class => [
      SendEmailVerificationNotification::class,
    ],
    Illuminate\Auth\Events\Verified::class => [
      \App\Listeners\LogVerifiedUser::class,
      \App\Listeners\SendEmailWelcomeNewUser::class,
    ],
    \App\Events\UserAddedToCollectionEvent::class => [
      \App\Listeners\SendEmailUserAddedToCollection::class,
    ],
    \App\Events\UserBecameAdminToCollectionEvent::class => [
      \App\Listeners\SendEmailUserBecameAdminToCollection::class,
    ],
    \App\Events\NewTextEvent::class => [
      \App\Listeners\SendEmailMembersNewText::class,
    ],
    \App\Events\CollectionDeletedEvent::class => [
      \App\Listeners\SendEmailMembersCollectionDeleted::class,
    ],
  ];

    /**
    * Register any events for your application.
    *
    * @return void
    */
    public function boot()
    {
        parent::boot();

        //
    }
}
