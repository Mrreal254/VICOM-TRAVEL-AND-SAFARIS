<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Supplier extends Model
{
    protected $fillable = [
        'uuid', 'business_name', 'slug', 'supplier_type', 'contact_name',
        'email', 'phone', 'description', 'address', 'city', 'country',
        'status', 'verification_status',
    ];

    protected static function booted(): void
    {
        static::creating(function ($supplier) {
            $supplier->uuid ??= (string) Str::uuid();
        });
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'supplier_users');
    }
}
