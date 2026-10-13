<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slide;

class SlideController extends ResourceController
{
    protected function model(): string { return Slide::class; }
    protected function base(): string { return 'admin.slides'; }
    protected function title(): string { return 'Home banner slides'; }
    protected function orderBy(): array { return ['sort_order' => 'asc', 'id' => 'asc']; }

    protected function fields(): array
    {
        $str = 'nullable|string|max:200';

        return [
            'title' => ['label' => 'Main title (for example the trek name)', 'type' => 'text', 'rules' => 'required|string|max:200'],
            'subtitle' => ['label' => 'Line under the title', 'type' => 'text', 'rules' => 'nullable|string|max:300', 'help' => 'Shown when there is no price text.'],
            'image' => ['label' => 'Background photo', 'type' => 'image', 'help' => 'Wide photo works best (about 1800 px). The text is written on top of it.'],
            'promo_top' => ['label' => 'Sale text, top line', 'type' => 'text', 'rules' => $str, 'help' => 'For example: Winter Treks. Leave all three sale boxes empty for a simple banner.'],
            'promo_main' => ['label' => 'Sale text, big word', 'type' => 'text', 'rules' => $str, 'help' => 'For example: Sale'],
            'promo_year' => ['label' => 'Sale text, year', 'type' => 'text', 'rules' => $str, 'help' => 'For example: 2026'],
            'button_text' => ['label' => 'Button text', 'type' => 'text', 'rules' => $str, 'help' => 'For example: Know more'],
            'button_url' => ['label' => 'Button link', 'type' => 'text', 'rules' => 'nullable|string|max:300', 'help' => 'For example /treks/kedarkantha or /category/season/winter'],
            'price_label' => ['label' => 'Price words', 'type' => 'text', 'rules' => $str, 'help' => 'For example: Starts from'],
            'price_text' => ['label' => 'Price', 'type' => 'text', 'rules' => $str, 'help' => 'For example: INR 6,499. Only write a real price. Empty hides the price line.'],
            'note' => ['label' => 'Small note (bottom)', 'type' => 'text', 'rules' => $str, 'help' => 'For example: Travel charges extra'],
            'sort_order' => ['label' => 'Order', 'type' => 'number', 'rules' => 'nullable|integer', 'default' => 0],
            'is_active' => ['label' => 'Show on site', 'type' => 'checkbox', 'default' => true],
        ];
    }

    protected function columns(): array
    {
        return ['image' => ['Photo', 'image'], 'title' => 'Title', 'sort_order' => 'Order', 'is_active' => ['Visible', 'bool']];
    }
}
