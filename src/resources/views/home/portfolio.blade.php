@extends('layouts.app')

@section('content')


  <div class="container">

    <!-- Application Portfolio -->
    <div class="row justify-content-center">

      <!-- Tabs -->
      <div class="col-md-3">
        <div class="card">
          <div class="card-header">
            <fa icon="tachometer-alt"></fa>
            Portfolio
          </div>
          
          <div class="card-body">

            <div class="card-text">
              {{ __('app.portfolio_description', ['name' => $user->name, 'collection_count' => $user->collections->count()]) }}
            </div>

            <search-input />


          </div>
        </div>
      </div>

      <!-- Main -->
      <div class="col-md-9">

        <div class="card">
          <div class="card-header">
            <fa icon="book"></fa>

            {{ __('app.my_collections') }}
            <small>{{ $user->collections->count() }}</small>
          </div>

          <div class="card-body">

            <div class="row">
              <div class="col">

                <a href="{{ route('collection.create') }}"
                class="btn btn-success pull-right">
                <fa icon="book"></fa>
                {{ __('app.new_collection') }}
              </a>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <portfolio
              page_url="{{ route('api.portfolio') }}">
            </portfolio>
          </div>
        </div>

      </div>



    </div>

  </div>
</div>


</div>
@endsection
