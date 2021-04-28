<?php

namespace App\Models;

use Cache;
use DB;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Text extends BaseModel
{
    use HasSlug;
    use Searchable;

    public $asYouType = true;

    protected $fillable = [
    'name',
    'abstract',
    'slug',
    'uploader_id',
  ];

    protected $dates = [
    'cached_at',
  ];

    /**
    * Get the route key for the model.
    *
    * @return string
    */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
    * Get the segments for the text.
    */
    public function segments()
    {
        return $this->hasMany('App\Models\Segment')->orderBy('position');
    }

    public function label_texts()
    {
        return $this->hasMany('App\Models\LabelText');
    }

    public function uploader()
    {
        return $this->hasOne('App\User', 'id', 'uploader_id');
    }

    /**
    * Get the collection that owns the text.
    */
    public function collection()
    {
        return $this->belongsTo('App\Models\Collection');
    }

    public function labels()
    {
        return $this->belongsToMany('App\Models\Label')
    ->withPivot('id', 'attribute')
    ->withTimestamps()
    ->whereNull('label_text.deleted_at');
    }

    public function tags()
    {
        return $this->hasManyThrough(
            'App\Models\Tag',
            'App\Models\SegmentTag',
            'segment_tag.text_id', // Foreign key on SegmentTag table...
      'tags.id', // Foreign key on Tag table...
      'id', // Local key on Text table...
      'segment_tag.tag_id' // Local key on SegmentTag table...
        )
      ->orderBy('tags.name')
      ->addSelect(['snippet_start', 'snippet_end']);
    }

    public function getTagsCloudAttribute()
    {
        $result = $this->hasManyThrough(
            'App\Models\Tag',
            'App\Models\SegmentTag',
            'segment_tag.text_id', // Foreign key on SegmentTag table...
        'tags.id', // Foreign key on Tag table...
        'id', // Local key on Text table...
        'segment_tag.tag_id' // Local key on SegmentTag table...
        )->select([
          'tags.id',
          'tags.name',
          'tags.color',
          DB::raw('count(tags.id) as occurrence'),
        ])
        ->groupBy('tags.name')
        ->orderBy('tags.name')
        ->get();

        $total = $result->sum('occurrence');

        $tags = $result->map(function ($tag, $key) use ($total, $result) {
            return [
            'id' => $tag->id,
            'name' => $tag->name,
            'occurrence' => $tag->occurrence,
            // 'parents_count' => $tag->parents()->count(),
            'children_count' => $tag->children()->count(),
            'size' => round(
                log(
                    $tag->occurrence /
                ($total / $result->count('name')) * 100
                ) * 30
            ),
              'color' => $tag->color ?? config('core_settings.default_color'),
              'href' => route('collection.tags.show', [$this->collection->slug, $tag->id]),
            ];
        });

        return $tags;
    }

    public function getStatsAttribute()
    {
        $key = 'text_stats_' . $this->id;

        if ($this->needToCache()) {
            $this->setCached();
            Cache::forget($key);
        }

        $segments = Cache::rememberForever($key, function () {
            return $this->hasMany('App\Models\Segment')->addselect([
              DB::raw('SUM(LENGTH(segments.content)) AS number_of_chars'),
              DB::raw("SUM(LENGTH(segments.content) - LENGTH(REPLACE(segments.content, ' ', ''))) AS number_of_words"),
              ])->get();
        });

        return collect([
              'number_of_chars' => [
                'name' => 'number_of_chars',
                'trans' => __('app.number_of_chars'),
                'value' => round($segments->first()->number_of_chars / 1000, 2) . 'k',
              ],
              'number_of_words' =>   [
                'name' => 'number_of_words',
                'trans' => __('app.number_of_words'),
                'value' => round($segments->first()->number_of_words / 1000, 2) . 'k',
              ],
              'reading_estimate' =>   [
                'name' => 'reading_estimate',
                'trans' => __('app.reading_estimate'),
                'value' => round($segments->first()->number_of_words / config('core_settings.reading_speed')) . ' ' . __('app.minutes'),
              ],
              'tagging_estimate' => [
                'name' => 'tagging_estimate',
                'trans' => __('app.tagging_estimate'),
                'value' => round($segments->first()->number_of_words /  config('core_settings.tagging_speed')) . ' ' . __('app.minutes'),
              ],

            ]);
    }

    public function getResumeAttribute()
    {
        return $this->name;
    }

    public function getLinkAttribute()
    {
        return route('collection.texts.show', [$this->collection, $this]);
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public static function boot()
    {
        parent::boot();

        self::deleting(function ($text) {
            $text->segments()->each(function ($segment) {
                $segment->delete();
            });
            $text->label_texts()->each(function ($label_text) {
                $label_text->delete();
            });
        });
    }
}
