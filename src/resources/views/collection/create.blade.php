@extends('layouts.app')

@section('content')
  <div class="container">
    <!-- Collection view -->
    <div class="row justify-content-center">


      <div class="col-md-9">

        <div class="card">

          <div class="card-header">
            <fa icon="book"></fa>
            Create
            <small>Collection</small>
          </div>
          <div class="card-body">

            {{-- {{ Form::model($collection, ['route' => ['collection.store']]) }} --}}

            {{ Form::open(['route' => ['collection.store']]) }}

            @include('partials.forms.form_collection_inc')

            <div class="pull-right">
              <a href="{{ URL::previous() }}" class="btn btn-secondary">
                <fa icon="ban"></fa>
                {{ __('app.cancel') }}
              </a>

              <button type="submit" name="submit" class="btn btn-success">
                <fa icon="save"></fa>
                {{ __('app.save') }}
              </button>


            </div>
            {!! Form::close() !!}
          </div>

        </div>
      </div>
    </div>
  </div>
@endsection
