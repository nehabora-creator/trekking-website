<?php

namespace App\Support;

use App\Models\Trek;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Everything about "Treks by Categories": the lists shown above the footer,
 * the category page addresses (/category/season/winter) and the season text
 * used by the marquee at the top of the site.
 */
class Categories
{
    public const MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    public const SEASONS = ['Spring', 'Summer', 'Monsoon', 'Autumn', 'Winter'];

    public const GRADES = ['Easy', 'Easy to Moderate', 'Moderate', 'Moderate to Difficult', 'Difficult', 'Challenging'];

    public const TYPES = [
        'month' => 'Month',
        'difficulty' => 'Difficulty',
        'experience' => 'Experience',
        'season' => 'Season',
        'duration' => 'Duration',
        'region' => 'Region',
        'country' => 'Country',
        'interest' => 'Interest',
        'theme' => 'Theme',
    ];

    public static function url(string $type, string $label): string
    {
        return route('categories.show', ['type' => $type, 'value' => Str::slug($label)]);
    }

    /** Links used by the header's "Choose Trek" menu. */
    // public static function menu(): array
    // {
    //     $treks = Trek::published()
    //         ->with('region')
    //         ->orderBy('sort_order')
    //         ->orderBy('title')
    //         ->get();

    //     $items = fn (string $type, array $labels) => array_map(
    //         fn ($label) => ['label' => $label, 'url' => self::url($type, $label)],
    //         array_values(array_unique(array_filter($labels)))
    //     );

    //     $grades = $treks->pluck('grade')->filter()->unique()->all();
    //     usort($grades, function ($a, $b) {
    //         $aOrder = array_search($a, self::GRADES, true);
    //         $bOrder = array_search($b, self::GRADES, true);

    //         return ($aOrder === false ? 99 : $aOrder) <=> ($bOrder === false ? 99 : $bOrder);
    //     });

    //     return [
    //         'treks' => $treks->map(fn ($trek) => [
    //             'label' => $trek->title,
    //             'url' => route('treks.show', $trek->slug),
    //         ])->all(),
    //         'months' => $items('month', self::MONTHS),
    //         'regions' => $items('region', $treks->pluck('region.name')->all()),
    //         'countries' => $items('country', $treks->pluck('region.country')->all()),
    //         'seasons' => $items('season', array_values(array_filter(self::SEASONS, fn ($season) => $treks->contains('season', $season)))),
    //         'grades' => $items('difficulty', $grades),
    //     ];
    // }

    public static function durationLabel(int $days): string
    {
        if ($days <= 3) {
            return '1 to 3 days';
        }
        if ($days >= 7) {
            return '7 or more days';
        }

        return $days.' days';
    }

    /** Season name for a date (used by the marquee). */
    public static function seasonFor($date = null): string
    {
        $m = ($date ?? now())->month;

        if (in_array($m, [12, 1, 2], true)) {
            return 'Winter';
        }
        if (in_array($m, [3, 4, 5], true)) {
            return 'Spring';
        }
        if ($m === 6) {
            return 'Summer';
        }
        if (in_array($m, [7, 8, 9], true)) {
            return 'Monsoon';
        }

        return 'Autumn';
    }

    /** The six boxes of the "Treks by Categories" section. */
    public static function all(): array
    {
        static $cache = null;
        if ($cache !== null) {
            return $cache;
        }

        $treks = Trek::published()->with('region')->get();

        $grades = $treks->pluck('grade')->unique()->all();
        usort($grades, fn ($a, $b) => (array_search($a, self::GRADES) === false ? 99 : array_search($a, self::GRADES))
            <=> (array_search($b, self::GRADES) === false ? 99 : array_search($b, self::GRADES)));

        $experiences = $treks->flatMap(fn ($t) => $t->tagList('experiences'))->unique()->values()->all();
        $seasons = array_values(array_filter(self::SEASONS, fn ($s) => $treks->contains('season', $s)));

        $durations = $treks->map(fn ($t) => self::durationLabel((int) $t->days))->unique()->all();
        usort($durations, fn ($a, $b) => (int) $a <=> (int) $b);

        $regions = $treks->pluck('region.name')->filter()->unique()->values()->all();

        $groups = [
            ['type' => 'month', 'title' => 'Treks by Month', 'icon' => 'calendar', 'labels' => self::MONTHS],
            ['type' => 'difficulty', 'title' => 'Treks by Difficulty', 'icon' => 'gauge', 'labels' => $grades],
            ['type' => 'experience', 'title' => 'Treks by Experience', 'icon' => 'users', 'labels' => $experiences],
            ['type' => 'season', 'title' => 'Treks by Season', 'icon' => 'sun', 'labels' => $seasons],
            ['type' => 'duration', 'title' => 'Treks by Duration', 'icon' => 'clock', 'labels' => $durations],
            ['type' => 'region', 'title' => 'Treks by Region', 'icon' => 'pin', 'labels' => $regions],
        ];

        $cache = [];
        foreach ($groups as $g) {
            if (! count($g['labels'])) {
                continue;
            }
            $cache[] = [
                'type' => $g['type'],
                'title' => $g['title'],
                'icon' => $g['icon'],
                'items' => array_map(fn ($label) => ['label' => $label, 'url' => self::url($g['type'], $label)], $g['labels']),
            ];
        }

        return $cache;
    }

    /**
     * Treks for one category page.
     *
     * @return array{0: Collection, 1: string} matching treks and the nice label
     */
    public static function find(string $type, string $slug): array
    {
        if (! isset(self::TYPES[$type])) {
            abort(404);
        }

        $treks = Trek::published()->with(['region', 'images'])->orderBy('sort_order')->orderBy('id')->get();
        $label = null;

        $tagMatch = function (string $field) use ($treks, $slug, &$label) {
            return $treks->filter(function ($t) use ($field, $slug, &$label) {
                foreach ($t->tagList($field) as $tag) {
                    if (Str::slug($tag) === $slug) {
                        $label = $label ?: $tag;

                        return true;
                    }
                }

                return false;
            });
        };

        switch ($type) {
            case 'month':
                $slugs = array_map(fn ($m) => Str::slug($m), self::MONTHS);
                $idx = array_search($slug, $slugs, true);
                if ($idx === false) {
                    abort(404);
                }
                $label = self::MONTHS[$idx];
                $matches = $treks->filter(fn ($t) => in_array($idx + 1, $t->bestMonthNumbers(), true));
                break;
            case 'difficulty':
                $matches = $treks->filter(fn ($t) => Str::slug($t->grade) === $slug);
                $label = $matches->first()?->grade;
                break;
            case 'season':
                $matches = $treks->filter(fn ($t) => Str::slug($t->season) === $slug);
                $label = $matches->first()?->season ?: (in_array(Str::title($slug), self::SEASONS, true) ? Str::title($slug) : null);
                break;
            case 'region':
                $matches = $treks->filter(fn ($t) => Str::slug((string) $t->region?->name) === $slug);
                $label = $matches->first()?->region?->name;
                break;
            case 'country':
                $matches = $treks->filter(fn ($t) => Str::slug((string) $t->region?->country) === $slug);
                $label = $matches->first()?->region?->country;
                break;
            case 'interest':
                $matches = $treks->filter(fn ($t) => Str::slug((string) $t->interest) === $slug);
                $label = $matches->first()?->interest;
                break;
            case 'experience':
                $matches = $tagMatch('experiences');
                break;
            case 'theme':
                $matches = $tagMatch('themes');
                break;
            case 'duration':
                $matches = $treks->filter(fn ($t) => Str::slug(self::durationLabel((int) $t->days)) === $slug);
                $label = $matches->first() ? self::durationLabel((int) $matches->first()->days) : null;
                break;
            default:
                abort(404);
        }

        return [$matches->values(), $label ?: Str::headline($slug)];
    }

    /** Text for the moving strip at the top of the site (changes with the season). */
    public static function marquee(): array
    {
        $now = now();
        $season = self::seasonFor($now);

        $treks = Trek::published()->orderBy('sort_order')->orderBy('id')->get()
            ->filter(fn ($t) => in_array($now->month, $t->bestMonthNumbers(), true) || $t->season === $season)
            ->take(10);

        return [
            'season' => $season,
            'month' => $now->format('F'),
            'treks' => $treks->map(fn ($t) => ['title' => $t->title, 'url' => route('treks.show', $t->slug)])->values()->all(),
            'url' => route('categories.show', ['type' => 'season', 'value' => Str::slug($season)]),
        ];
    }

    public static function menu(): array
    {
        $treks = Trek::published()
            ->with('region')
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        $items = fn (string $type, array $labels) => array_map(
            fn ($label) => ['label' => $label, 'url' => self::url($type, $label)],
            array_values(array_unique(array_filter($labels)))
        );

        $grades = $treks->pluck('grade')->filter()->unique()->all();
        usort($grades, fn ($a, $b) => (array_search($a, self::GRADES, true) ?: 99)
            <=> (array_search($b, self::GRADES, true) ?: 99));

        return [
            'treks' => $treks->map(fn ($trek) => [
                'label' => $trek->title,
                'url' => route('treks.show', $trek->slug),
            ])->all(),
            'months' => $items('month', self::MONTHS),
            'regions' => $items('region', $treks->pluck('region.name')->all()),
            'countries' => $items('country', $treks->pluck('region.country')->all()),
            'seasons' => $items('season', array_values(array_filter(self::SEASONS, fn ($season) => $treks->contains('season', $season)))),
            'grades' => $items('difficulty', $grades),
        ];
    }

}
