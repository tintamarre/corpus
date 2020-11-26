@extends('layouts.app')

@section('content')
  <div class="container">

    <profile page_url="{{ route('api.profile') }}" />

  </div>
@endsection
