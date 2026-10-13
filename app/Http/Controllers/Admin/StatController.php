<?php

namespace App\Http\Controllers\Admin;

use App\Models\Stat;

class StatController extends ResourceController
{
    protected function model(): string { return Stat::class; }
    protected function base(): string { return 'admin.stats'; }
    protected function title(): string { return 'Numbers (Why trek with us)'; }
    protected function orderBy(): array { return ['sort_order' => 'asc', 'id' => 'asc']; }

    protected function fields(): array
    {
        return [
            'icon' => ['label' => 'Icon', 'type' => 'select', 'rules' => 'required|string', 'options' => icon_options(), 'default' => 'mtn'],
            'number' => ['label' => 'Number', 'type' => 'number', 'rules' => 'required|integer|min:0'],
            'suffix' => ['label' => 'After the number', 'type' => 'text', 'rules' => 'nullable|string|max:5', 'default' => '+'],
            'title' => ['label' => 'Title', 'type' => 'text', 'rules' => 'required|string|max:100'],
            'caption' => ['label' => 'Small text', 'type' => 'text', 'rules' => 'nullable|string|max:200'],
            'sort_order' => ['label' => 'Order', 'type' => 'number', 'rules' => 'nullable|integer', 'default' => 0],
        ];
    }

    protected function columns(): array
    {
        return ['title' => 'Title', 'number' => 'Number', 'caption' => 'Small text', 'sort_order' => 'Order'];
    }
}
