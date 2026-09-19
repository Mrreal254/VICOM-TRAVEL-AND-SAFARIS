<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerProfile extends Model
{
    protected $fillable = [
        'user_id', 'date_of_birth', 'country', 'city', 'address',
        'passport_number', 'nationality', 'preferred_language',
        'emergency_contact_name', 'emergency_contact_phone',
    ];

    protected $hidden = ['passport_number'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
