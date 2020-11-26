@extends('layouts.app')

@section('content')
  <div class="container">
    <!-- Collection view -->
    <div class="row justify-content-center">


      <div class="col-md-12">

        <div class="card">

          <div class="card-header">
            <fa icon="book"></fa> {{ __('app.collection') }}
            <a href="{{ route('collection.edit', [$collection->slug]) }}" class="btn pull-right btn-sm">
              <fa icon="cogs"></fa>
            </a>
          </div>


          <div class="card-body">

            <collection-data
            page_url="{{ route('api.collection.show', [$collection]) }}"
            >
          </collection-data>

          <texts-table
          page_url="{{ route('api.collection.texts.index', [$collection]) }}"
          >
        </texts-table>

        <a href="{{ route('collection.texts.create', [$collection]) }}"
        class="btn btn-success pull-right">

        {{ __('app.new_text') }}
        <fa icon="file-alt"></fa>

      </a>

    </div>
  </div>
</div>
</div>

</div>
@endsection
