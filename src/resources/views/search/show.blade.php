@extends('layouts.app')

@section('content')
  <div class="container">

    <search
    query="{{ $query }}"
    page_url="{{ route('api.search', [$query]) }}"
    />

  </div>
@endsection
