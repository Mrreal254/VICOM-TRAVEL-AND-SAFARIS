<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Destination extends Model
{
    protected $fillable = [
        'uuid', 'name', 'slug', 'country', 'region', 'city',
        'short_description', 'description', 'latitude', 'longitude',
        'featured', 'status', 'seo_title', 'seo_description',
    ];

    protected $casts = ['featured' => 'boolean'];

    protected static function booted(): void
    {
        static::creating(function ($destination) {
            $destination->uuid ??= (string) Str::uuid();
        });
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }
}
