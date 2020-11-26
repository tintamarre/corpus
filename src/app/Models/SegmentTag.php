<?php

namespace App\Models;

class SegmentTag extends BaseModel
{
    protected $table = 'segment_tag';

    protected $appends = [

  ];

    protected $fillable = [
    'segment_id',
    'text_id',
    'tag_id',
    'snippet_start',
    'snippet_end',
    'user_id',
  ];

    public function tag()
    {
        return $this->belongsTo('App\Models\Tag');
    }

    public function segment()
    {
        return $this->belongsTo('App\Models\Segment');
    }

    public static function boot()
    {
        parent::boot();

        self::deleting(function ($segment_tag) {
            $tag = $segment_tag->tag()->first();

            // 1 because it's excuted before calling delete on the model
            if ($tag->segment_tag()->count() == 1 && $tag->children()->count() == 0) {
                $tag->delete();
            }
        });
    }
}
