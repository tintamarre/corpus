@component('mail::message')
# New admin to collection <em>{{ $event->collection->name }}</em>

<strong>{{ $event->user->name }}</strong> has been promoted as administrator to the collection {{ $event->collection->name }}

@component('mail::button', ['url' => route('collection.show', [$event->collection])])
View collection
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
