@extends('layouts.app')

@section('content')
  <div class="container">
    <!-- Text create view -->
    <div class="row">
      <div class="col-md-12 col-lg-12">
        <div class="card">

          <div class="card-header">{{ __('app.create_new_text') }}</div>

          <div class="card-body">

            {!! Form::open(['url'  => route('collection.texts.store', $collection->slug)]) !!}

            <input type="text" name="uploader_id" value="{{ Auth::id() }}" hidden>

            {!! Form::textField('name') !!}

            {!! Form::textareaField('abstract') !!}

            <div class="pull-right">
              {!! Form::button(__("app.create_new_text") . ' <i class="fa fa-floppy-o"></i>', array('type' => 'submit', 'class' => 'btn btn-primary')) !!}
              {!! Form::close() !!}
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection
