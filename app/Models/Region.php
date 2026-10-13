<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    protected $guarded = [];

    public function treks(): HasMany
    {
        return $this->hasMany(Trek::class);
    }
}
