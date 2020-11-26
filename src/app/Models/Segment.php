<?php

namespace App\Models;

use Laravel\Scout\Searchable;

class Segment extends BaseModel
{
    use Searchable;

    public $asYouType = true;

    protected $fillable = [
    'content',
    'position',
  ];

    /**
    * Get the text that owns the segment.
    */
    public function text()
    {
        return $this->belongsTo('App\Models\Text');
    }

    /**
    * The tags that belong to the segment.
    */
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag')
    ->withPivot('id', 'snippet_start', 'snippet_end', 'user_id')
    ->withTimestamps()
    ->orderBy('snippet_start')
    ->whereNull('segment_tag.deleted_at');
    }

    public function segment_tags()
    {
        return $this->hasMany('App\Models\SegmentTag')
    ->whereNull('segment_tag.deleted_at');
    }

    public function getNumberOfLinesAttribute()
    {
        $paragraphs = preg_split('#(\r\n?|\n)+#', $this->content);
        $number_of_lines = 0;
        foreach ($paragraphs as $paragraph) {
            $line_of_paragraph = ceil(strlen($paragraph) / 80); // width: 66ch;
            $number_of_lines = $number_of_lines + $line_of_paragraph;
        }

        return $number_of_lines;
    }

    public function getSnippetsAttribute()
    {
        $tags = $this->tags()->get();

        $snippets = collect();
        foreach ($tags as $tag) {
            $length = $tag->pivot->snippet_end - $tag->pivot->snippet_start;
            $snippet_content = mb_substr(
                $this->content,
                $tag->pivot->snippet_start,
                $length
            );
            $snippets->push(
                [
          'snippet_content' => $snippet_content,
          'segment_content' => $this->content,
          'snippet_start' => $tag->pivot->snippet_start,
          'snippet_end' => $tag->pivot->snippet_end,
          'top_offset' => $tag->top_offset,
          'segment_id' => $this->id,
          'tag_id' => $tag->id,
          'user_id' => $tag->pivot->user_id,
          'segment_tag_id' => $tag->pivot->id,
          'length' => $length,
        ]
            );
        }

        return $snippets;
    }

    public static function boot()
    {
        parent::boot();

        self::created(function ($segment) {
            self::orderSegments($segment);
            self::resetCache($segment);
        });

        self::updated(function ($segment) {
            self::orderSegments($segment);
            self::resetCache($segment);
        });

        self::deleting(function ($segment) {
            // before delete() method call this
            foreach ($segment->segment_tags()->pluck('id') as $segment_tag_id) {
                \App\Models\SegmentTag::find($segment_tag_id)->delete();
            }
        });

        self::deleted(function ($segment) {
            self::resetCache($segment);
        });
    }

    public static function orderSegments($segment)
    {
        $text = \App\Models\Text::find($segment->text_id);

        $segments = $text->segments()
    ->orderBy('position')
    ->orderBy('updated_at', 'ASC')
    ->get();

        foreach ($segments as $key => $segment) {
            $segment->position = $key;
            $segment->save();
        }
    }

    public static function resetCache($segment)
    {
        $text = \App\Models\Text::find($segment->text_id);
        $text->cached_at = null;
        $text->save();

        $collection = \App\Models\Collection::find($text->collection_id);
        $collection->cached_at = null;
        $collection->save();
    }

    public function getResumeAttribute()
    {
        return $this->text->name;
    }

    public function getLinkAttribute()
    {
        return route('collection.texts.show', [$this->text->collection, $this->text]);
    }
}
