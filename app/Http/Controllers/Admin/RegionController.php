<?php

namespace App\Http\Controllers\Admin;

use App\Models\Region;

class RegionController extends ResourceController
{
    protected function model(): string { return Region::class; }
    protected function base(): string { return 'admin.regions'; }
    protected function title(): string { return 'Regions'; }
    protected function orderBy(): array { return ['sort_order' => 'asc', 'name' => 'asc']; }

    protected function fields(): array
    {
        return [
            'name' => ['label' => 'Region name', 'type' => 'text', 'rules' => 'required|string|max:100'],
            'country' => ['label' => 'Country', 'type' => 'text', 'rules' => 'required|string|max:60', 'default' => 'India', 'help' => 'Used by the Country filter. For example: India or Nepal.'],
            'image' => ['label' => 'Region photo', 'type' => 'image', 'help' => 'Shown on the region filter button and the region banner.'],
            'sort_order' => ['label' => 'Order', 'type' => 'number', 'rules' => 'nullable|integer', 'default' => 0],
        ];
    }

    protected function columns(): array
    {
        return ['image' => ['Photo', 'image'], 'name' => 'Name', 'country' => 'Country', 'sort_order' => 'Order'];
    }
}
