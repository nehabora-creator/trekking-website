<?php

namespace App\Http\Controllers\Admin;

use App\Models\FaqCategory;

class FaqCategoryController extends ResourceController
{
    protected function model(): string { return FaqCategory::class; }
    protected function base(): string { return 'admin.faq-categories'; }
    protected function title(): string { return 'FAQ tabs (categories)'; }
    protected function orderBy(): array { return ['sort_order' => 'asc', 'id' => 'asc']; }

    protected function fields(): array
    {
        return [
            'name' => ['label' => 'Tab name', 'type' => 'text', 'rules' => 'required|string|max:100'],
            'icon' => ['label' => 'Icon', 'type' => 'select', 'rules' => 'required|string', 'options' => icon_options(), 'default' => 'book'],
            'sort_order' => ['label' => 'Order', 'type' => 'number', 'rules' => 'nullable|integer', 'default' => 0],
        ];
    }

    protected function columns(): array
    {
        return ['name' => 'Tab', 'icon' => 'Icon', 'sort_order' => 'Order'];
    }
}
