<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierUser extends Model
{
    protected $table = 'supplier_users';
    protected $fillable = ['supplier_id', 'user_id'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
