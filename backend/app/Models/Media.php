<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Media extends Model
{
    protected $fillable = [
        'uuid', 'model_type', 'model_id', 'collection', 'disk',
        'path', 'url', 'alt_text', 'caption', 'sort_order',
    ];

    protected static function booted(): void
    {
        static::creating(function ($media) {
            $media->uuid ??= (string) Str::uuid();
        });
    }

    public function model()
    {
        return $this->morphTo();
    }
}
