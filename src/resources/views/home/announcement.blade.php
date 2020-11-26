@extends('layouts.app')

@section('content')
  <div class="container">

    <!-- Application Announcement -->
    <div class="row justify-content-center">
      <div class="col">

        <h1>{{ __('app.announcement') }}</h1>
      </div>
    </div>

    <div class="row">
      <div class="col">

        @foreach (\App\Models\Announcement::orderBy('created_at', 'DESC')->get() as $announcement)
          <div class="card">
            <div class="card-header">
              {{ $announcement->title }}

              <small class="pull-right">
                {{ $announcement->created_at->diffForHumans() }}
              </small>
            </div>
            <div class="card-body">
              <div class="card-text">
                {!! $announcement->body !!}
              </div>
            </div>

          </div>
        @endforeach
      </div>
    </div>
  </div>
@endsection
