<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'uuid', 'user_id', 'action', 'entity_type', 'entity_id',
        'ip_address', 'user_agent', 'old_values', 'new_values', 'created_at',
    ];

    protected $casts = ['old_values' => 'array', 'new_values' => 'array', 'created_at' => 'datetime'];
}
