

@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            {{ $label->name }}
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-md-6">

                <h1 class="header">{{ $label->name }}</h1>
                <table class="table">
                  <tr>
                    <th class="text-right">{{ __('app.format') }}</th>
                    <td>{{ $label->format }}</td>
                  </tr>
                  <tr>
                    <th class="text-right">{{ __('app.description') }}</th>
                    <td>{{ $label->description }}</td>
                  </tr>
                </table>
              </div>

              <div class="col-md-6">

                <timeline-ex>
                </timeline-ex>


                <h2>{{ __('app.count') }}</h2>
                {{ $label->label_texts->count() }}
                <h2>{{ __('app.distinct') }}</h2>
                {{ $label->label_texts->groupBy('attribute')->count() }}

                <labels-chart page_url="{{ route('api.collection.chart.labels.data', [$label->collection, $label]) }}"></labels-chart>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
