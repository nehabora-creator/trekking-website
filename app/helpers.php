<?php

use App\Models\Setting;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

if (! function_exists('img_url')) {
    /** Public URL for an image path stored in the database (images/... or uploads/...). */
    function img_url(?string $path): ?string
    {
        if (! $path) {
            return null;
        }
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return asset($path);
    }
}

if (! function_exists('store_upload')) {
    /** Move an uploaded file into public/uploads and return its path (uploads/xyz.jpg). */
    function store_upload(UploadedFile $file): string
    {
        $dir = public_path('uploads');
        if (! is_dir($dir)) {
            mkdir($dir, 0775, true);
        }
        $name = Str::random(20).'.'.strtolower($file->getClientOriginalExtension() ?: 'jpg');
        $file->move($dir, $name);

        return 'uploads/'.$name;
    }
}

if (! function_exists('setting')) {
    /** Read a value from the settings table (cached for the request). */
    function setting(string $key, $default = null)
    {
        static $all = null;
        if ($all === null) {
            try {
                $all = Setting::query()->pluck('value', 'key')->all();
            } catch (\Throwable $e) {
                $all = [];
            }
        }

        $value = $all[$key] ?? null;

        return ($value === null || $value === '') ? $default : $value;
    }
}

if (! function_exists('lines')) {
    /** Turn a textarea value (one item per line) into an array. */
    function lines(?string $text): array
    {
        $parts = preg_split('/\r\n|\r|\n/', (string) $text) ?: [];

        return array_values(array_filter(array_map('trim', $parts), fn ($l) => $l !== ''));
    }
}

if (! function_exists('icon_options')) {
    function icon_options(): array
    {
        return [
            'users' => 'People', 'mtn' => 'Mountain', 'trophy' => 'Trophy', 'clock' => 'Clock',
            'sprout' => 'Sprout', 'shield' => 'Shield', 'cross' => 'First aid', 'food' => 'Food',
            'leaf' => 'Leaf', 'book' => 'Book', 'calendar' => 'Calendar', 'tag' => 'Tag',
            'repeat' => 'Repeat', 'badge' => 'Badge', 'person' => 'Person',
        ];
    }
}
