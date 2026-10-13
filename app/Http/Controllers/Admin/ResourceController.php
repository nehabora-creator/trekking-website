<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Small generic CRUD controller. Each admin screen (slides, reviews, posts...)
 * extends this and only describes its fields and table columns.
 */
abstract class ResourceController extends Controller
{
    /** @return class-string<\Illuminate\Database\Eloquent\Model> */
    abstract protected function model(): string;

    /** Route name prefix, for example "admin.slides". */
    abstract protected function base(): string;

    abstract protected function title(): string;

    /** name => [label, type, rules?, options?, default?, help?] */
    abstract protected function fields(): array;

    /** name => label, or name => [label, type] (types: text, image, bool, limit, date) */
    abstract protected function columns(): array;

    protected function with(): array
    {
        return [];
    }

    protected function orderBy(): array
    {
        return ['id' => 'desc'];
    }

    protected function extraRules(): array
    {
        return [];
    }

    protected function extraView(): ?string
    {
        return null;
    }

    protected function prepare(array $data, Request $request, $item = null): array
    {
        return $data;
    }

    protected function afterSave(Request $request, $item): void
    {
        //
    }

    public function index()
    {
        $class = $this->model();
        $query = $class::query()->with($this->with());
        foreach ($this->orderBy() as $column => $direction) {
            $query->orderBy($column, $direction);
        }

        return view('admin.resource.index', [
            'items' => $query->paginate(20),
            'title' => $this->title(),
            'base' => $this->base(),
            'columns' => $this->columns(),
        ]);
    }

    public function create()
    {
        $class = $this->model();

        return $this->form(new $class());
    }

    public function store(Request $request)
    {
        $class = $this->model();
        $item = $class::create($this->collect($request));
        $this->afterSave($request, $item);

        return redirect()->route($this->base().'.index')->with('success', 'Saved.');
    }

    public function edit($id)
    {
        $class = $this->model();

        return $this->form($class::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $class = $this->model();
        $item = $class::findOrFail($id);
        $item->update($this->collect($request, $item));
        $this->afterSave($request, $item);

        return redirect()->route($this->base().'.index')->with('success', 'Saved.');
    }

    public function destroy($id)
    {
        $class = $this->model();
        $class::findOrFail($id)->delete();

        return redirect()->route($this->base().'.index')->with('success', 'Deleted.');
    }

    protected function form($item)
    {
        return view('admin.resource.form', [
            'item' => $item,
            'title' => $this->title(),
            'base' => $this->base(),
            'fields' => $this->fields(),
            'extra' => $this->extraView(),
        ]);
    }

    /** Validate the request and return only the values we store. */
    protected function collect(Request $request, $item = null): array
    {
        $rules = $this->extraRules();
        foreach ($this->fields() as $name => $f) {
            if ($f['type'] === 'images') {
                continue;
            }
            $rules[$name] = $f['rules'] ?? ($f['type'] === 'image' ? 'nullable|image|max:5120' : 'nullable');
        }
        $validated = $request->validate($rules);

        $data = [];
        foreach ($this->fields() as $name => $f) {
            $type = $f['type'];
            if ($type === 'images') {
                continue;
            }
            if ($type === 'checkbox') {
                $data[$name] = $request->boolean($name);
            } elseif ($type === 'image') {
                if ($request->hasFile($name)) {
                    $data[$name] = store_upload($request->file($name));
                }
            } else {
                $value = $validated[$name] ?? null;
                if (($value === null || $value === '') && array_key_exists('default', $f)) {
                    $value = $f['default'];
                }
                $data[$name] = $value;
            }
        }

        return $this->prepare($data, $request, $item);
    }

    /** Make a unique slug from a title for the given model class. */
    protected function uniqueSlug(string $class, ?string $wanted, string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($wanted ?: $title) ?: 'item';
        $slug = $base;
        $n = 2;
        while ($class::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base.'-'.$n++;
        }

        return $slug;
    }
}
