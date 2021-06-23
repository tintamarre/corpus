@if(env('APP_DEBUG') == true)
@if(isset($collection) && Auth::user()->id == 1)
<samp>
    Perms of {{ Auth::user()->name }}:
    @if (Gate::allows('view-collection', $collection))
    <strong class="text-primary">... can view collection</strong>
    @else
    <strong class="text-danger">... cannot view collection</strong>
    @endif

    @if (Gate::allows('detach-user', $collection))
    <strong class="text-primary">... can exit</strong>
    @else
    <strong class="text-danger">... cannot exit</strong>
    @endif

    @if (Gate::allows('change-role', $collection))
    <strong class="text-primary">... can change user pivot</strong>
    @else
    <strong class="text-danger">... cannot change user pivot</strong>
    @endif

</samp>
@endif
@endif
