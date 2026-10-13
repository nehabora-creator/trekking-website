<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;
use App\Models\Feature;
use App\Models\Post;
use App\Models\Review;
use App\Models\Slide;
use App\Models\Stat;
use App\Models\Trek;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $treks = Trek::published()
            ->with([
                'region',
                'images',
                'departures' => fn ($q) => $q->whereDate('start_date', '>=', now()->toDateString()),
            ])
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $favIds = $request->user()
            ? $request->user()->favorites()->pluck('treks.id')->all()
            : [];

        $regions = $treks->pluck('region')->filter()->unique('id')->sortBy('sort_order')->values();

        $slides = Slide::where('is_active', true)->orderBy('sort_order')->orderBy('id')->get();

        $reviews = Review::where('is_published', true)
            ->with('trek.images')
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        $appData = [
            'user' => (bool) $request->user(),
            'loginUrl' => route('login'),
            'favUrl' => route('favorites.toggle', '__ID__'),
            'siteName' => setting('site_name', 'Himalaya Trails'),
            'slides' => $slides->map(fn ($s) => [
                't' => $s->title,
                's' => $s->subtitle,
                'img' => img_url($s->image),
            ])->values(),
            'regions' => $regions->map(fn ($r) => [
                'name' => $r->name,
                'country' => $r->country,
                'image' => img_url($r->image),
            ])->values(),
            'treks' => $treks->map(fn ($t) => [
                'id' => $t->id,
                'title' => $t->title,
                'region' => $t->region?->name,
                'country' => $t->region?->country ?? 'India',
                'months' => $t->bestMonthNumbers(),
                'interest' => $t->interest,
                'themes' => $t->tagList('themes'),
                'upcoming' => $t->departures->isNotEmpty(),
                'days' => $t->days,
                'grade' => $t->grade,
                'season' => $t->season,
                'text' => $t->short_text,
                'img1' => img_url($t->images->get(0)?->path),
                'img2' => img_url($t->images->get(1)?->path),
                'url' => route('treks.show', $t->slug),
                'fav' => in_array($t->id, $favIds, true),
                'badge' => $t->badge,
            ])->values(),
        ];

        return view('home', [
            'appData' => $appData,
            'treks' => $treks,
            'regions' => $regions,
            'slides' => $slides,
            'updates' => Post::where('is_published', true)->where('type', 'update')->latest()->get(),
            'articles' => Post::where('is_published', true)->where('type', 'article')->latest()->get(),
            'stats' => Stat::orderBy('sort_order')->orderBy('id')->get(),
            'features' => Feature::orderBy('sort_order')->orderBy('id')->get(),
            'reviews' => $reviews,
            'reviewAvg' => $reviews->count() ? round($reviews->avg('rating'), 1) : null,
            'faqCategories' => FaqCategory::with('faqs')->orderBy('sort_order')->orderBy('id')->get(),
            'favIds' => $favIds,
        ]);
    }
}
