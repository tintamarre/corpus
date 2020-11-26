
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="">
  <div class="container">
    <ol class="breadcrumb">
      
      <li class="breadcrumb-item">
        <i class="fa fa-fw fa-btn fa-dashboard"></i>
        <a href="{{ ('portfolio')}}">
          Portfolio
        </a>
      </li>

      @if(isset($collection->id) && ($collection->count() == 1))
        <li class="breadcrumb-item">
          <i class="fa fa-fw fa-btn fa-book"></i>
          <a href="{{ ('collection.show', [$collection->id, $collection->slug]) }}">
            {{ $collection->name }}
          </a>
          {{ $collection->pivot->role ?? 'no role' }}
        </li>
      @endif

      @if(isset($text->id) && ($text->count() == 1))
        <li class="breadcrumb-item">
          <i class="fa fa-fw fa-btn fa-file-text-o"></i>
          {{ $text->name }}
        </li>
      @endif

      @if(isset($tag->id) && ($tag->count() == 1))
        <li class="breadcrumb-item">
          <i class="fa fa-fw fa-btn fa-tag"></i>
          {{ $tag->name }}
        </li>
      @endif

    </ol>
  </div>
</nav>
