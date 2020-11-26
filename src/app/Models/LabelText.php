<?php

namespace App\Models;

class LabelText extends BaseModel
{
    protected $table = 'label_text';

    protected $fillable = [
    'text_id',
    'label_id',
    'attribute',
  ];

    public function text()
    {
        return $this->belongsTo('App\Models\Text');
    }

    public function label()
    {
        return $this->belongsTo('App\Models\Label');
    }

    public static function boot()
    {
        parent::boot();

        self::deleting(function ($label_text) {
            $label = $label_text->label()->first();

            // 1 because it's excuted before calling delete on the model
            if ($label->label_texts()->count() == 1) {
                $label->delete();
            }
        });
    }
}
