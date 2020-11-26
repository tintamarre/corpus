<?php

namespace App\Models;

class Label extends BaseModel
{
    protected $fillable = [
    'name',
    'format',
    'collection_id',
    'description',
  ];

    protected $appends = ['type'];

    public function texts()
    {
        return $this->belongsToMany('App\Models\Text')
    ->withPivot('id', 'attribute')
    ->withTimestamps()
    ->whereNull('label_text.deleted_at');
    }

    public function label_texts()
    {
        return $this->hasMany('App\Models\LabelText')->orderBy('attribute');
    }

    public function collection()
    {
        return $this->belongsTo('App\Models\Collection');
    }

    public static function boot()
    {
        parent::boot();

        self::deleting(
            function ($label) {
                $label->label_texts()->each(function ($label_text) {
                    $label_text->delete();
                });
            }
        );
    }
}
