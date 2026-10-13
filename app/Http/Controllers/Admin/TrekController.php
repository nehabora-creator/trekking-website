<?php

namespace App\Http\Controllers\Admin;

use App\Models\Region;
use App\Models\Trek;
use Illuminate\Http\Request;

class TrekController extends ResourceController
{
    protected function model(): string { return Trek::class; }
    protected function base(): string { return 'admin.treks'; }
    protected function title(): string { return 'Treks'; }
    protected function with(): array { return ['region', 'images']; }
    protected function orderBy(): array { return ['sort_order' => 'asc', 'id' => 'asc']; }
    protected function extraView(): ?string { return 'admin.treks.departures'; }
    protected function extraRules(): array { return ['images.*' => 'image|max:5120', 'remove_images.*' => 'integer']; }

    protected function fields(): array
    {
        return [
            'title' => ['label' => 'Trek name', 'type' => 'text', 'rules' => 'required|string|max:200'],
            'slug' => ['label' => 'Address (slug)', 'type' => 'text', 'rules' => 'nullable|string|max:200', 'help' => 'Leave empty to create it from the name. Page address: /treks/your-slug'],
            'region_id' => ['label' => 'Region', 'type' => 'select', 'rules' => 'nullable|exists:regions,id', 'options' => Region::orderBy('name')->pluck('name', 'id')->all()],
            'days' => ['label' => 'Days', 'type' => 'number', 'rules' => 'required|integer|min:1|max:60'],
            'grade' => ['label' => 'Grade', 'type' => 'select', 'rules' => 'required|string|max:50', 'options' => array_combine(['Easy', 'Easy to Moderate', 'Moderate', 'Difficult', 'Challenging'], ['Easy', 'Easy to Moderate', 'Moderate', 'Difficult', 'Challenging'])],
            'season' => ['label' => 'Main season', 'type' => 'select', 'rules' => 'required|string|max:30', 'options' => array_combine(['Spring', 'Summer', 'Autumn', 'Monsoon', 'Winter'], ['Spring', 'Summer', 'Autumn', 'Monsoon', 'Winter'])],
            'short_text' => ['label' => 'One-line text (card)', 'type' => 'text', 'rules' => 'nullable|string|max:255'],
            'overview' => ['label' => 'Overview', 'type' => 'textarea', 'rows' => 6],
            'highlights' => ['label' => 'Highlights (one per line)', 'type' => 'textarea', 'rows' => 4],
            'base_camp' => ['label' => 'Base camp', 'type' => 'text', 'rules' => 'nullable|string|max:150'],
            'max_altitude' => ['label' => 'Max altitude (metres)', 'type' => 'number', 'rules' => 'nullable|integer|min:0'],
            'distance_km' => ['label' => 'Trekking distance (km)', 'type' => 'number', 'rules' => 'nullable|integer|min:0'],
            'best_months' => ['label' => 'Best months', 'type' => 'text', 'rules' => 'nullable|string|max:100', 'help' => 'Format: Mar to May, Oct to Nov'],
            'interest' => ['label' => 'Interest', 'type' => 'select', 'rules' => 'required|string|max:50', 'options' => array_combine(['Trekking', 'Mountaineering', 'Pilgrimage Tours', 'Multi Sports'], ['Trekking', 'Mountaineering', 'Pilgrimage Tours', 'Multi Sports']), 'default' => 'Trekking'],
            'themes' => ['label' => 'Themes', 'type' => 'text', 'rules' => 'nullable|string|max:255', 'help' => 'Separate with commas. For example: Snow, Lakes, Beginner, Peaks View'],
            'experiences' => ['label' => 'Experiences', 'type' => 'text', 'rules' => 'nullable|string|max:255', 'help' => 'Separate with commas. For example: Family Treks, Senior Treks, Stargazing Treks'],
            'itinerary' => ['label' => 'Itinerary (one day per line)', 'type' => 'textarea', 'rows' => 8],
            'inclusions' => ['label' => 'Inclusions (one per line)', 'type' => 'textarea', 'rows' => 5],
            'exclusions' => ['label' => 'Exclusions (one per line)', 'type' => 'textarea', 'rows' => 5],
            'essentials' => ['label' => 'Trek essentials (one per line)', 'type' => 'textarea', 'rows' => 6],
            'cancellation' => ['label' => 'Cancellation policy', 'type' => 'textarea', 'rows' => 4],
            'price' => ['label' => 'Price per person (Rs.)', 'type' => 'number', 'rules' => 'nullable|integer|min:0', 'help' => 'Leave empty to show "Price on request".'],
            'price_note' => ['label' => 'Price note', 'type' => 'text', 'rules' => 'nullable|string|max:60', 'help' => 'For example: + 5% GST'],
            'badge' => ['label' => 'Badge', 'type' => 'text', 'rules' => 'nullable|string|max:30', 'help' => 'For example: Trending or Best Seller. Empty means no badge.'],
            'rating' => ['label' => 'Rating (0 to 5)', 'type' => 'number', 'step' => '0.1', 'rules' => 'nullable|numeric|between:0,5', 'help' => 'Only fill this with a real rating. Empty hides it.'],
            'rating_count' => ['label' => 'Number of ratings', 'type' => 'number', 'rules' => 'nullable|integer|min:0'],
            'sort_order' => ['label' => 'Order', 'type' => 'number', 'rules' => 'nullable|integer', 'default' => 0],
            'is_published' => ['label' => 'Show on site', 'type' => 'checkbox', 'default' => true],
            'images' => ['label' => 'Photos', 'type' => 'images'],
        ];
    }

    protected function columns(): array
    {
        return ['cover' => ['Photo', 'cover'], 'title' => 'Trek', 'region.name' => 'Region', 'days' => 'Days', 'grade' => 'Grade', 'is_published' => ['Visible', 'bool']];
    }

    protected function prepare(array $data, Request $request, $item = null): array
    {
        $data['slug'] = $this->uniqueSlug(Trek::class, $data['slug'] ?? null, $data['title'], $item?->id);

        return $data;
    }

    protected function afterSave(Request $request, $item): void
    {
        if ($request->hasFile('images')) {
            $next = (int) $item->images()->max('sort_order') + 1;
            foreach ($request->file('images') as $file) {
                $item->images()->create(['path' => store_upload($file), 'sort_order' => $next++]);
            }
        }

        $remove = $request->input('remove_images', []);
        if (is_array($remove) && count($remove)) {
            $item->images()->whereIn('id', $remove)->delete();
        }
    }
}
