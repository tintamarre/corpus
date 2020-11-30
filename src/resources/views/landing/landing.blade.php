@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            {{ config('app.name', '') }}

          </div>

          <div class="card-body">
            @auth

              <a href="{{ route('portfolio') }}"
              class="btn btn-success pull-right">
              <fa icon="tachometer-alt"></fa>
              {{ __('app.portfolio') }}
            </a>
          @endauth

          <h2>About Corpus</h2>
          <p>

            In order to simplify and facilitate a methodology for corpus analysis (interviews, focus groups, press articles, etc.), Corpus offers a service that is both simple and efficient, based on The experience gained in qualitative methodology. The methodology proposed by Corpus comprises three essential steps. We distinguish exploration, stripping and analysis.
            <ul>

              <li>Exploration, first of all, allows the social scientist to prepare his field work, whether it be interviews, threads of discussion or any other textual corpus.</li>
              <li>It allows the drafting of the analysis grid, the socialization of the professional with his subject of study and prepares him for the counting phase. The counting, meanwhile, will confront the professional to his object of study by allowing him to proceed with different sorts which assure him never to "miss out" the relevant information.</li>
              <li>Finally, the analysis gives the professional the raw material which will be necessary for him to draw up his conclusions.</li>
            </ul>

            Corpus makes you work more efficiently, more faithfully to your corpus and in record time.

          </p>




          {{-- <h2>Core</h2>
          <ul>
          <li>
          <a href="https://lltl.be">
          lltl.be
        </a>
      </li>
      <li>
      <a href="https://corpus.lltl.be">
      corpus.lltl.be
    </a>
  </li>
  <li>
  <a href="https://docs.lltl.be">
  corpus-docs.lltl.be
</a>
</li>
</ul> --}}
{{-- <h2>Design principles</h2>
<ul>
<li>Should be free for ULiège members ;</li>
<li>Should be open source [<a href="https://opensource.org/licenses/MIT">MIT License</a>] ;</li>
<li>One should be able to tag content easily ;</li>
<li>One should be able to edit content once inserted ;</li>
<li>Tag should be multilevel (be parent of one other) ;</li>
<li>
<mark>
Should be documented ;
</mark>
</li>
<li>
<mark>
One should be able to import content from various sources and formats ;
</mark>
</li>
<li>
<mark>
One should be able to share content with other members ;
</mark>
</li>
<li>
<mark>
One should be able to export data to a reusable and printable format ;
</mark>
</li>
<li>
<mark>
Analysis should be shareable and removable and swipeable:
</mark>

<ul>
<li>Should be independent from content itself ;</li>
</ul>
</li>

</ul>

<h2>Inspirations</h2>
<ul>
<li>https://sites.google.com/site/bplenum/</li>
<li>thesaurus universel utu doctrine</li>
<li>http://www.servicedoc.info/spip.php?article355&lang=fr</li>
<li>https://bartoc.org/en/node/369</li>
</ul>
--}}

<h2>Team</h2>
<ul>
  @foreach (config('core_settings.project_partners') as $value)
    <li>{{ $value['person_in_charge'] }} — <a href="{{ $value['url'] }}">{{ $value['name'] }}</a></li>
  @endforeach
  <li>{{ config('core_settings.person_in_charge') }}</li>
</ul>

<div class="text-right">
  <img src="{{ asset('storage/legaltech_logo.png') }}" width="240px" alt="">
</div>

</div>

<div class="card-footer">
  <div class="text-center small">
    <a href="{{ config('core_settings.license_url') }}">GPLv3 License</a> | <a href="{{ config('core_settings.git_source_code') }}">Source code on Gitlab</a>
    <br />
    Project by <em>{{ config('core_settings.project_name') }}</em> from <a href="{{ config('core_settings.promotor_url') }}" alt="">{{ config('core_settings.promotor_name') }}</a>
  </div>
</div>
</div>
</div>
</div>
</div>
@endsection
