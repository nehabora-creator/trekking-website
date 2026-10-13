<?php

namespace App\Http\Controllers\Admin;

use App\Models\Feature;

class FeatureController extends ResourceController
{
    protected function model(): string { return Feature::class; }
    protected function base(): string { return 'admin.features'; }
    protected function title(): string { return 'Why us points'; }
    protected function orderBy(): array { return ['sort_order' => 'asc', 'id' => 'asc']; }

    protected function fields(): array
    {
        return [
            'icon' => ['label' => 'Icon', 'type' => 'select', 'rules' => 'required|string', 'options' => icon_options(), 'default' => 'shield'],
            'title' => ['label' => 'Title', 'type' => 'text', 'rules' => 'required|string|max:100'],
            'text' => ['label' => 'Text', 'type' => 'textarea', 'rules' => 'nullable|string|max:400', 'rows' => 3],
            'sort_order' => ['label' => 'Order', 'type' => 'number', 'rules' => 'nullable|integer', 'default' => 0],
        ];
    }

    protected function columns(): array
    {
        return ['title' => 'Title', 'text' => ['Text', 'limit'], 'sort_order' => 'Order'];
    }
}
