<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LabelSelectResource;
use App\Http\Resources\TagSelectResource;
use App\Models\Collection;
use App\Models\Tag;

class ApiCollectionResourcesController extends Controller
{
    public function __construct()
    {
    }

    public function labels(Collection $collection)
    {
        $labels = config('core_settings.labels');

        return LabelSelectResource::collection($labels);
    }

    public function tags(Collection $collection)
    {
        return TagSelectResource::collection($collection->tags);
    }

    public function parent_tags(Collection $collection, Tag $tag)
    {
        // Tags for the multiselect menu.
        return TagSelectResource::collection($collection->tags()
        ->where('id', '!=', $tag->id) // Can't be self
        ->whereNotIn('id', $tag->children->pluck('id')) // Can't be both children and selectable to be parent
        ->get());
    }
}
