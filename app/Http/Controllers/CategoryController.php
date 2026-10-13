<?php

namespace App\Http\Controllers;

use App\Models\Trek;
use App\Support\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /** All categories on one page. */
    public function index()
    {
        return view('categories.index');
    }

    /** One category, for example /category/season/winter or /category/month/may */
    public function show(string $type, string $value)
    {
        [$treks, $label] = Categories::find($type, $value);
        $typeLabel = Categories::TYPES[$type];

        return view('categories.show', [
            'heading' => $label.' Treks',
            'crumb' => $typeLabel,
            'sub' => 'Treks by '.strtolower($typeLabel).': '.$treks->count().' '.($treks->count() === 1 ? 'trek' : 'treks').' found.',
            'treks' => $treks,
        ]);
    }

    /** Header search box: /search?q=kedar */
    public function search(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $treks = collect();

        if ($q !== '') {
            $like = '%'.$q.'%';
            $treks = Trek::published()
                ->with(['region', 'images'])
                ->where(function ($w) use ($like) {
                    $w->where('title', 'like', $like)
                        ->orWhere('short_text', 'like', $like)
                        ->orWhere('grade', 'like', $like)
                        ->orWhere('season', 'like', $like)
                        ->orWhereHas('region', fn ($r) => $r->where('name', 'like', $like));
                })
                ->orderBy('sort_order')
                ->get();
        }

        return view('categories.show', [
            'heading' => $q !== '' ? 'Search results for "'.$q.'"' : 'Search treks',
            'crumb' => 'Search',
            'sub' => $q !== '' ? $treks->count().' '.($treks->count() === 1 ? 'trek' : 'treks').' found.' : 'Type a trek name, region, season or grade in the search box.',
            'treks' => $treks,
        ]);
    }
}
