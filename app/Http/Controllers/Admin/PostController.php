<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends ResourceController
{
    protected function model(): string { return Post::class; }
    protected function base(): string { return 'admin.posts'; }
    protected function title(): string { return 'Updates and articles'; }

    protected function fields(): array
    {
        return [
            'type' => ['label' => 'Type', 'type' => 'select', 'rules' => 'required|in:update,article', 'options' => ['update' => 'Trek update', 'article' => 'Article']],
            'title' => ['label' => 'Title', 'type' => 'text', 'rules' => 'required|string|max:200'],
            'slug' => ['label' => 'Address (slug)', 'type' => 'text', 'rules' => 'nullable|string|max:200', 'help' => 'Leave empty to create it from the title.'],
            'excerpt' => ['label' => 'Short text (shown on the card)', 'type' => 'text', 'rules' => 'nullable|string|max:300'],
            'body' => ['label' => 'Full text', 'type' => 'textarea', 'rows' => 8],
            'image' => ['label' => 'Photo', 'type' => 'image'],
            'is_published' => ['label' => 'Show on site', 'type' => 'checkbox', 'default' => true],
        ];
    }

    protected function columns(): array
    {
        return ['image' => ['Photo', 'image'], 'type' => 'Type', 'title' => 'Title', 'is_published' => ['Visible', 'bool']];
    }

    protected function prepare(array $data, Request $request, $item = null): array
    {
        $data['slug'] = $this->uniqueSlug(Post::class, $data['slug'] ?? null, $data['title'], $item?->id);

        return $data;
    }
}
