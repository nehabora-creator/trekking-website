<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enquiry extends Model
{
    protected $guarded = [];

    public function trek(): BelongsTo
    {
        return $this->belongsTo(Trek::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
