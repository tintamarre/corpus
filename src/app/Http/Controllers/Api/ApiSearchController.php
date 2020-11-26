<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SearchResource;
use Auth;
use TeamTNT\TNTSearch\Indexer\TNTIndexer;

class ApiSearchController extends Controller
{
    public function __construct()
    {
    }

    public function query($query)
    {
        $results = $this->getResults($query);

        if ($results['result_count'] > 0) {
            return [
        'data' => [
          'query' => $query,
          'didyoumean' => false,
          'results' => $results,
        ],
      ];
        }

        return [
      'data' => [
        'query' => $query,
        'didyoumean' => true,
        'results' => $this->getSuggestions($query),
      ],
    ];
    }

    private function getResults($query)
    {
        $own_collections = Auth::user()->collections()->get();
        $own_collections_ids = $own_collections->pluck('id');

        $own_texts = \App\Models\Text::whereIn('collection_id', $own_collections_ids)->get();

        $own_tags = \App\Models\Tag::whereIn('collection_id', $own_collections_ids)->get();

        $own_segments = \App\Models\Segment::whereIn('text_id', $own_texts->pluck('id'))
        ->get();

        $collections = \App\Models\Collection::search($query)->get()->whereIn('id', $own_collections_ids);

        $texts = \App\Models\Text::search($query)->get()->whereIn('id', $own_texts->pluck('id'));

        $tags = \App\Models\Tag::search($query)->get()->whereIn('id', $own_tags->pluck('id'));

        $segments = \App\Models\Segment::search($query)->get()->whereIn('id', $own_segments->pluck('id'));

        $resources = collect($collections)->merge($texts)->merge($tags)->merge($segments);

        $results = SearchResource::using($query);
        $results = SearchResource::collection($resources);

        return collect(
            [
        'result_count' => $results->count(),
        'results' => $results,

      ]
        );
    }

    private function getSuggestions($query)
    {
        $indexer = new TNTIndexer;
        $trigrams = $indexer->buildTrigrams($query);

        return $this->getResults($trigrams);
    }
}
