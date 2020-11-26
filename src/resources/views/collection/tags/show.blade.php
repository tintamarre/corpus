@extends('layouts.app')

@section('content')
  <div class="container">

    <!-- Tabs -->
    <div class="row">
      <div class="col-md-12">
        <div class="card">


            <tag-component
            page_url="{{ route('api.collection.tags.show', [$collection, $tag]) }}"
            colors="{{ json_encode(config('core_settings.colors')) }}" />

          </div>
      </div>
    </div>

  </div>
@endsection
