<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreOwner extends Model
{
    /** @use HasFactory<\Database\Factories\StoreOwnerFactory> */
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stores()
    {
        return $this->hasMany(Store::class);
    }
}
