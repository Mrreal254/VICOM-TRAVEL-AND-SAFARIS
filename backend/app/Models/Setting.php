<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'type', 'group', 'description'];

    protected static function booted(): void
    {
        static::saving(function ($setting) {
            if ($setting->type === 'json' && is_array($setting->value)) {
                $setting->value = json_encode($setting->value);
            }
        });
    }
}
