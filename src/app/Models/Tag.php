<?php

namespace App\Models;

use Laravel\Scout\Searchable;

class Tag extends BaseModel
{
    use Searchable;

    public $asYouType = true;

    protected $fillable = [
    'name',
    'collection_id',
    'tag_id',
    'color',
    'description',
  ];

    /**
    * Get the collection.
    */
    public function collection()
    {
        return $this->belongsTo('App\Models\Collection');
    }

    /**
    * The parents tags that own to the tag.
    */
    public function parents()
    {
        return $this->belongsToMany(self::class, 'tags_child_parent', 'child_id', 'parent_id');
    }

    /**
    * The children tags that belong to the tag.
    */
    public function children()
    {
        return $this->belongsToMany(self::class, 'tags_child_parent', 'parent_id', 'child_id');
    }

    public function segment_tag()
    {
        return $this->hasMany('App\Models\SegmentTag')
    ->whereNull('segment_tag.deleted_at');
    }

    /**
    * The tags that belong to the segment.
    */
    public function segments()
    {
        return $this->belongsToMany('App\Models\Segment')
    ->withPivot('id', 'snippet_start', 'snippet_end', 'user_id')
    ->withTimestamps()
    ->orderBy('id')
    ->orderBy('position')
    ->orderBy('snippet_start')
    ->whereNull('segment_tag.deleted_at');
    }

    public function getSnippetsAttribute()
    {
        $segments = $this->segments()->get();

        $snippets = collect();
        foreach ($segments as $segment) {
            $length = $segment->pivot->snippet_end - $segment->pivot->snippet_start;
            $snippet_content = mb_substr(
                $segment->content,
                $segment->pivot->snippet_start,
                $length
            );
            $snippets->push(
                [
          'snippet_content' => $snippet_content,
          'segment_content' => $segment->content,
          'snippet_start' => $segment->pivot->snippet_start,
          'snippet_end' => $segment->pivot->snippet_end,
          'segment_id' => $this->id,
          'tag_id' => $segment->pivot->tag_id,
          'user_id' => $segment->pivot->user_id,
          'author' => \App\User::find($segment->pivot->user_id)->name,
          'segment_tag_id' => $segment->pivot->id,
          'length' => $length,
          'links' => [
            'api_destroy' => route('api.collection.segment_tag.destroy', [$segment->text->collection, $segment->pivot]),
            // 'api_rename' => route('api.collection.segment_tag.rename', [$segment->text->collection, $segment->pivot]),
          ],
          'text' => [
            'name' => $segment->text->name,
            'links' => [
              'self' => route('collection.texts.show', [$segment->text->collection, $segment->text]),

            ],
          ],
        ]
            );
        }

        return $snippets;
    }

    public function getTagsCloudAttribute()
    {
        $result = $this->hasMany(self::class)->orderBy('name')
    ->withCount('segment_tag')
    ->orderBy('tags.name')
    ->get();

        $total = $result->sum('segment_tag_count');

        $tags = $result->map(function ($tag, $key) use ($total, $result) {
            return [
        'id' => $tag->id,
        'name' => $tag->name,
        'occurrence' => $tag->segment_tag_count,
        'children_count' => $tag->children()->count(),
        'size' => round(
            log(
                $tag->segment_tag_count /
            ($total / $result->count('id')) * 100
            ) * 30
        ),
          'color' => $tag->color ?? config('core_settings.default_color'),
          'href' => route('collection.tags.show', [$this->collection->slug, $tag->id]),
        ];
        });

        return $tags;
    }

    public function getResumeAttribute()
    {
        return $this->name;
    }

    public function getLinkAttribute()
    {
        return route('collection.tags.show', [$this->collection, $this]);
    }
}
