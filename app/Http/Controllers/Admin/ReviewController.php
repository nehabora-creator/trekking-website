<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use App\Models\Trek;

class ReviewController extends ResourceController
{
    protected function model(): string { return Review::class; }
    protected function base(): string { return 'admin.reviews'; }
    protected function title(): string { return 'Reviews'; }
    protected function with(): array { return ['trek']; }
    protected function orderBy(): array { return ['sort_order' => 'asc', 'id' => 'desc']; }

    protected function fields(): array
    {
        return [
            'name' => ['label' => 'Reviewer name', 'type' => 'text', 'rules' => 'required|string|max:120'],
            'trek_id' => ['label' => 'Trek', 'type' => 'select', 'rules' => 'nullable|exists:treks,id', 'options' => Trek::orderBy('title')->pluck('title', 'id')->all()],
            'rating' => ['label' => 'Rating (1 to 5)', 'type' => 'number', 'rules' => 'required|integer|between:1,5', 'default' => 5],
            'body' => ['label' => 'Review text', 'type' => 'textarea', 'rules' => 'required|string|max:1500', 'rows' => 5],
            'image' => ['label' => 'Photo (optional)', 'type' => 'image', 'help' => 'If empty, the trek photo is used.'],
            'sort_order' => ['label' => 'Order', 'type' => 'number', 'rules' => 'nullable|integer', 'default' => 0],
            'is_published' => ['label' => 'Show on site', 'type' => 'checkbox', 'default' => true],
        ];
    }

    protected function columns(): array
    {
        return ['name' => 'Name', 'trek.title' => 'Trek', 'rating' => 'Stars', 'body' => ['Review', 'limit'], 'is_published' => ['Visible', 'bool']];
    }
}
