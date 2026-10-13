<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use App\Models\FaqCategory;

class FaqController extends ResourceController
{
    protected function model(): string { return Faq::class; }
    protected function base(): string { return 'admin.faqs'; }
    protected function title(): string { return 'FAQ questions'; }
    protected function with(): array { return ['category']; }
    protected function orderBy(): array { return ['faq_category_id' => 'asc', 'sort_order' => 'asc', 'id' => 'asc']; }

    protected function fields(): array
    {
        return [
            'faq_category_id' => ['label' => 'Tab', 'type' => 'select', 'rules' => 'required|exists:faq_categories,id', 'options' => FaqCategory::orderBy('sort_order')->pluck('name', 'id')->all()],
            'question' => ['label' => 'Question', 'type' => 'text', 'rules' => 'required|string|max:300'],
            'answer' => ['label' => 'Answer', 'type' => 'textarea', 'rules' => 'required|string', 'rows' => 5],
            'sort_order' => ['label' => 'Order', 'type' => 'number', 'rules' => 'nullable|integer', 'default' => 0],
        ];
    }

    protected function columns(): array
    {
        return ['category.name' => 'Tab', 'question' => 'Question', 'sort_order' => 'Order'];
    }
}
