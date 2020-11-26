<?php

namespace App\Models;

use Cache;
use DB;
use Laravel\Scout\Searchable;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Collection extends BaseModel
{
    use HasSlug;

    use Searchable;
    public $asYouType = true;

    protected $fillable = [
    'name',
    'description',
    'slug',
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

    public function resolveRouteBinding($value, $field = null)
    {
        return $this->where('slug', $value)->firstOrFail();
    }
    /**
    * Get the texts for the collection.
    */
    public function texts()
    {
        return $this->hasMany('App\Models\Text')->orderBy('updated_at', 'desc');
    }

    public function collection_users()
    {
        return $this->hasMany('App\Models\CollectionUser')->orderBy('updated_at', 'desc');
    }

    /**
    * Get the segments for the collection.
    */
    public function segments()
    {
        return $this->hasManyThrough('App\Models\Segment', 'App\Models\Text');
    }

    /**
    * Get the tags for the collection.
    */
    public function tags()
    {
        return $this->hasMany('App\Models\Tag')
    ->withCount('segments')
    ->orderBy('name', 'asc');
    }

    /**
    * The labels that belong to the collection.
    */
    public function labels()
    {
        return $this->hasMany(
            'App\Models\Label',
        )
      ->withCount('label_texts')
      ->groupBy('labels.id')
      ->orderBy('labels.name');
    }

    /**
    * The owners that belong to the collection.
    */
    public function admins()
    {
        return $this->belongsToMany('App\User')
      ->withPivot('role')
      ->whereRole('admin')
      ->withTimestamps()
      ->orderBy('role', 'asc');
    }

    /**
    * The users that belong to the collection.
    */
    public function users()
    {
        return $this->belongsToMany('App\User')
      ->withPivot('role')
      ->withTimestamps()
      ->orderBy('role', 'asc');
    }

    public function getStatsAttribute()
    {
        $key = 'collection_stats_' . $this->id;

        if ($this->needToCache()) {
            $this->setCached();
            Cache::forget($key);
        }

        return Cache::rememberForever($key, function () {
            $segments = $this->hasManyThrough(
                'App\Models\Segment',
                'App\Models\Text'
            )->addselect([
            DB::raw('SUM(LENGTH(segments.content)) AS number_of_chars'),
            DB::raw("SUM(LENGTH(segments.content) - LENGTH(REPLACE(segments.content, ' ', ''))) AS number_of_words"),
            ])->get();

            $number_of_words = $segments->first()->number_of_words;

            if ($number_of_words / config('core_settings.reading_speed') < 2) {
                $reading_estimate = round($number_of_words / config('core_settings.reading_speed')) . ' ' . __('app.minutes');
            } else {
                $reading_estimate = round($number_of_words / config('core_settings.reading_speed') / 60) . ' ' . __('app.hours');
            }

            if ($number_of_words / config('core_settings.tagging_speed') < 2) {
                $tagging_estimate = round($number_of_words / config('core_settings.tagging_speed')) . ' ' . __('app.minutes');
            } else {
                $tagging_estimate = round($number_of_words / config('core_settings.tagging_speed') / 60) . ' ' . __('app.hours');
            }

            return collect([
              'number_of_chars' => [
                'name' => 'number_of_chars',
                'trans' => __('app.number_of_chars'),
                'value' => round($segments->first()->number_of_chars / 1000, 2) . 'k',
              ],
              'number_of_words' =>   [
                'name' => 'number_of_words',
                'trans' => __('app.number_of_words'),
                'value' => round($number_of_words / 1000, 2) . 'k',
              ],
              'reading_estimate' =>   [
                'name' => 'reading_estimate',
                'trans' => __('app.reading_estimate'),
                'value' => $reading_estimate,
              ],
              'tagging_estimate' => [
                'name' => 'tagging_estimate',
                'trans' => __('app.tagging_estimate'),
                'value' => $tagging_estimate,
              ],
            ]);
        });
    }

    public function getTagsCloudAttribute()
    {
        $result = $this->hasMany(
            'App\Models\Tag',
        )
            ->Join('segment_tag', 'tags.id', '=', 'segment_tag.tag_id')
            ->select([
              'tags.id',
              'tags.name',
              'tags.color',
              DB::raw('count(segment_tag.id) as occurrence'),
            ])
            ->groupBy('tags.id')
            ->whereNull('segment_tag.deleted_at')
            ->orderBy('tags.name')
            ->get();

        $total = $result->sum('occurrence');

        $tags = $result->map(function ($tag, $key) use ($total, $result) {
            return [
                'id' => $tag->id,
                'name' => $tag->name,
                'occurrence' => $tag->occurrence,
                'children_count' => $tag->children()->count(),

                'size' => round(
                    log(
                        $tag->occurrence /
                    ($total / $result->count('name')) * 100
                    ) * 30
                ),
                  'color' => $tag->color ?? config('core_settings.default_color'),
                  'href' => route('collection.tags.show', [$this, $tag]),
                ];
        });

        return $tags;
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
              ->generateSlugsFrom('name')
              ->saveSlugsTo('slug');
    }

    public function getResumeAttribute()
    {
        return $this->name;
    }

    public function getLinkAttribute()
    {
        return route('collection.show', $this);
    }

    public static function boot()
    {
        parent::boot();

        self::deleting(function ($collection) {
            foreach ($collection->collection_users()->pluck('id') as $user_collection_id) {
                \App\Models\CollectionUser::find($user_collection_id)->delete();
            }
            $collection->texts()->each(function ($text) {
                $text->delete();
            });
            $collection->tags()->each(function ($tag) {
                $tag->delete();
            });
            $collection->labels()->each(function ($label) {
                $label->delete();
            });
        });
    }
}
