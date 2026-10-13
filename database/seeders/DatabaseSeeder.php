<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\FaqCategory;
use App\Models\Feature;
use App\Models\Post;
use App\Models\Region;
use App\Models\Review;
use App\Models\Setting;
use App\Models\Slide;
use App\Models\Stat;
use App\Models\Trek;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /** Fills the site with sample content. Everything can be edited in /admin. */
    public function run(): void
    {
        $data = json_decode(file_get_contents(__DIR__.'/data.json'), true);

        // Admin account (change the password after you log in!)
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin', 'password' => 'password', 'is_admin' => true]
        );

        foreach ($data['settings'] as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        $regions = [];
        foreach ($data['regions'] as $r) {
            $regions[$r['name']] = Region::updateOrCreate(
                ['name' => $r['name']],
                ['image' => $r['image'], 'country' => $r['country'] ?? 'India', 'sort_order' => $r['sort_order']]
            );
        }

        foreach ($data['slides'] as $i => $s) {
            Slide::updateOrCreate(
                ['title' => $s['title']],
                array_merge(
                    collect($s)->except('title')->all(),
                    ['sort_order' => $i, 'is_active' => true]
                )
            );
        }

        $treksByTitle = [];
        foreach ($data['treks'] as $t) {
            $trek = Trek::updateOrCreate(
                ['slug' => $t['slug']],
                [
                    'region_id' => $regions[$t['region']]->id ?? null,
                    'title' => $t['title'],
                    'days' => $t['days'],
                    'grade' => $t['grade'],
                    'season' => $t['season'],
                    'short_text' => $t['short_text'],
                    'overview' => $t['overview'],
                    'highlights' => implode("\n", $t['highlights']),
                    'base_camp' => $t['base_camp'],
                    'max_altitude' => $t['max_altitude'],
                    'distance_km' => $t['distance_km'],
                    'best_months' => $t['best_months'],
                    'interest' => $t['interest'] ?? 'Trekking',
                    'themes' => $t['themes'] ?? null,
                    'experiences' => $t['experiences'] ?? null,
                    'itinerary' => implode("\n", $t['itinerary']),
                    'inclusions' => implode("\n", $data['inclusions']),
                    'exclusions' => implode("\n", $data['exclusions']),
                    'essentials' => implode("\n", $data['essentials']),
                    'cancellation' => 'Add your own cancellation and refund terms here, for example how much is refunded 30, 15 and 7 days before the trek.',
                    'price_note' => '+ GST',
                    'is_published' => true,
                    'sort_order' => $t['sort_order'],
                ]
            );
            $treksByTitle[$trek->title] = $trek;

            if ($trek->images()->count() === 0) {
                foreach ($t['images'] as $i => $path) {
                    $trek->images()->create(['path' => $path, 'sort_order' => $i]);
                }
            }

            // Sample fixed departures for the next 12 months (best months only).
            if ($trek->departures()->count() === 0) {
                $nums = $trek->bestMonthNumbers();
                $start = Carbon::now()->startOfMonth();
                for ($i = 0; $i < 12; $i++) {
                    $month = $start->copy()->addMonths($i);
                    if (! in_array($month->month, $nums, true)) {
                        continue;
                    }
                    $d = $month->copy()->day(5);
                    while (! $d->isSaturday()) {
                        $d->addDay();
                    }
                    foreach ([$d->copy(), $d->copy()->addDays(14)] as $date) {
                        if ($date->isFuture()) {
                            $trek->departures()->create(['start_date' => $date->toDateString()]);
                        }
                    }
                }
            }
        }

        foreach ($data['reviews'] as $i => $r) {
            Review::updateOrCreate(
                ['name' => $r['name'], 'body' => $r['body']],
                [
                    'trek_id' => isset($treksByTitle[$r['trek']]) ? $treksByTitle[$r['trek']]->id : null,
                    'rating' => 5,
                    'is_published' => true,
                    'sort_order' => $i,
                ]
            );
        }

        foreach ($data['posts'] as $p) {
            Post::updateOrCreate(
                ['slug' => Str::slug($p['title'])],
                [
                    'type' => $p['type'],
                    'title' => $p['title'],
                    'excerpt' => $p['excerpt'],
                    'body' => $p['body'],
                    'image' => $p['image'],
                    'is_published' => true,
                ]
            );
        }

        foreach ($data['faq'] as $i => $c) {
            $cat = FaqCategory::updateOrCreate(['name' => $c['name']], ['icon' => $c['icon'], 'sort_order' => $i]);
            foreach ($c['items'] as $j => $item) {
                Faq::updateOrCreate(
                    ['faq_category_id' => $cat->id, 'question' => $item['q']],
                    ['answer' => $item['a'], 'sort_order' => $j]
                );
            }
        }

        foreach ($data['stats'] as $i => $s) {
            Stat::updateOrCreate(
                ['title' => $s['title']],
                ['icon' => $s['icon'], 'number' => $s['number'], 'suffix' => $s['suffix'], 'caption' => $s['caption'], 'sort_order' => $i]
            );
        }

        foreach ($data['features'] as $i => $f) {
            Feature::updateOrCreate(
                ['title' => $f['title']],
                ['icon' => $f['icon'], 'text' => $f['text'], 'sort_order' => $i]
            );
        }
    }
}
