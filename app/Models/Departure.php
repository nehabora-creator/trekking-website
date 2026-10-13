<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Departure extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return ['start_date' => 'date'];
    }

    public function trek(): BelongsTo
    {
        return $this->belongsTo(Trek::class);
    }
}
