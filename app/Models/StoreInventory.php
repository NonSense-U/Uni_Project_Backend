<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreInventory extends Model
{
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
