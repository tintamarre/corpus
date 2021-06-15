@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <text-main
        page_url={{ route('api.collection.texts.show', [$text->collection, $text]) }} />
</div>
@endsection
