<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trek extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'rating' => 'float',
        ];
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(TrekImage::class)->orderBy('sort_order')->orderBy('id');
    }

    public function departures(): HasMany
    {
        return $this->hasMany(Departure::class)->orderBy('start_date');
    }

    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    /** First photo path, or null. */
    public function coverPath(): ?string
    {
        return $this->images->first()?->path;
    }

    /** Month numbers (1-12) parsed from text like "Mar to May, Oct to Nov". */
    public function bestMonthNumbers(): array
    {
        $names = ['Jan' => 1, 'Feb' => 2, 'Mar' => 3, 'Apr' => 4, 'May' => 5, 'Jun' => 6,
                  'Jul' => 7, 'Aug' => 8, 'Sep' => 9, 'Oct' => 10, 'Nov' => 11, 'Dec' => 12];
        $out = [];

        foreach (preg_split('/\s*,\s*/', (string) $this->best_months) as $part) {
            $part = trim($part);
            if ($part === '') {
                continue;
            }
            if (str_contains($part, ' to ')) {
                [$a, $b] = array_map('trim', explode(' to ', $part, 2));
                if (! isset($names[$a], $names[$b])) {
                    continue;
                }
                $i = $names[$a];
                $guard = 0;
                while ($guard++ < 13) {
                    $out[] = $i;
                    if ($i === $names[$b]) {
                        break;
                    }
                    $i = $i % 12 + 1;
                }
            } elseif (isset($names[$part])) {
                $out[] = $names[$part];
            }
        }

        return array_values(array_unique($out));
    }

    /** Comma separated field (themes, experiences...) as an array. */
    public function tagList(string $field): array
    {
        $raw = (string) ($this->{$field} ?? '');

        return array_values(array_filter(array_map('trim', explode(',', $raw)), fn ($v) => $v !== ''));
    }

    public function altitudeFeet(): ?int
    {
        return $this->max_altitude ? (int) (round($this->max_altitude * 3.28084 / 100) * 100) : null;
    }
}
