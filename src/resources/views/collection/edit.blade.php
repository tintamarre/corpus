@extends('layouts.app')

@section('content')
  <div class="container">
    <!-- Collection view -->
    <div class="row justify-content-center">


      <div class="col-md-9">

        <div class="card">

          <div class="card-header">
            <fa icon="book"></fa>
            <small>Collection</small>
          </div>
          <div class="card-body">

            <div class="row">
              <div class="col-md-8">
                <h4>{{ __('app.edit') }}</h4>


                {!! Form::model($collection, ['url' => route('collection.update', [$collection]), 'method' => 'PATCH']) !!}

                @include('partials.forms.form_collection_inc')

                <div class="pull-right">


                  <a href="{{ URL::previous() }}" class="btn btn-secondary">
                    <fa icon="ban"></fa>
                    {{ __('app.discard') }}
                  </a>


                  <button type="submit" name="button" class="btn btn-success">
                    <fa icon="save"></fa>
                    {{ __('app.save') }}
                  </button>

                </div>
                {!! Form::close() !!}
              </div>

              @can('delete-collection', $collection)
                <div class="col-md-4">
                  <h4>{{ __('app.danger_zone') }}</h4>

                  <form-delete-collection
                  page_url="{{ route('api.collection.show', [$collection]) }}"
                  />

                </div>
              @endcan

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
