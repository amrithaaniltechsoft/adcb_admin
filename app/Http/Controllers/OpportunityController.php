<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\File;

class OpportunityController extends Controller
{
    public function index()
    {
        return view('opportunities.index');
    }

    public function data()
    {
        $opportunities = Opportunity::orderBy('sort_order')->get();

        return response()->json([
            'data' => $opportunities->map(function (Opportunity $opportunity) {
                return [
                    'id' => $opportunity->id,
                    'slug' => $opportunity->slug,
                    'title' => $opportunity->title,
                    'description' => $opportunity->description,
                    'image' => $opportunity->image,
                    'image_url' => $this->resolveUrl($opportunity->image),
                    'flag' => $opportunity->flag,
                    'flag_url' => $this->resolveUrl($opportunity->flag),
                    'sort_order' => $opportunity->sort_order,
                    'action' => '<button type="button" data-id="' . $opportunity->id . '" class="btn btn-sm btn-info mr-1 btn-view" title="View"><i class="fas fa-eye"></i></button>' .
                        '<button type="button" data-id="' . $opportunity->id . '" data-slug="' . e($opportunity->slug) . '" data-title="' . e($opportunity->title) . '" data-description="' . e($opportunity->description) . '" data-image="' . ($opportunity->image ? $this->resolveUrl($opportunity->image) : '') . '" data-flag="' . ($opportunity->flag ? $this->resolveUrl($opportunity->flag) : '') . '" data-sort-order="' . $opportunity->sort_order . '" class="btn btn-sm btn-warning mr-1 btn-edit" title="Edit"><i class="fas fa-edit"></i></button>' .
                        '<button type="button" data-id="' . $opportunity->id . '" class="btn btn-sm btn-danger btn-delete" title="Delete"><i class="fas fa-trash"></i></button>',
                ];
            }),
        ]);
    }

    public function show(Opportunity $opportunity)
    {
        return view('opportunities.show', compact('opportunity'));
    }

    public function edit(Opportunity $opportunity)
    {
        return view('opportunities.edit', compact('opportunity'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->rules());
        $validated['slug'] = $this->uniqueSlug(Str::slug($request->input('title')));

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('opportunities', 'public');
        }

        if ($request->hasFile('flag')) {
            $validated['flag'] = $request->file('flag')->store('opportunities', 'public');
        }

        Opportunity::create($validated);

        return back()->with('status', 'Opportunity saved successfully.');
    }

    public function update(Request $request, Opportunity $opportunity): RedirectResponse
    {
        $validated = $request->validate($this->rules($opportunity));

        if ($request->hasFile('image')) {
            if ($opportunity->image) {
                Storage::delete($opportunity->image);
            }

            $validated['image'] = $request->file('image')->store('opportunities', 'public');
        }

        if ($request->hasFile('flag')) {
            if ($opportunity->flag) {
                Storage::delete($opportunity->flag);
            }

            $validated['flag'] = $request->file('flag')->store('opportunities', 'public');
        }

        $opportunity->update($validated);

        return redirect()->route('opportunities.index')->with('status', 'Opportunity updated successfully.');
    }

    public function destroy(Opportunity $opportunity): RedirectResponse
    {
        if ($opportunity->image) {
            Storage::delete($opportunity->image);
        }

        if ($opportunity->flag) {
            Storage::delete($opportunity->flag);
        }

        $opportunity->delete();

        return back()->with('status', 'Opportunity deleted successfully.');
    }

    public function publicIndex()
    {
        return response()->json([
            'data' => Opportunity::orderBy('sort_order')
                ->orderBy('id')
                ->get()
                ->map(fn (Opportunity $opportunity) => [
                    'slug' => $opportunity->slug,
                    'title' => $opportunity->title,
                    'description' => $opportunity->description,
                    'image' => $this->resolveUrl($opportunity->image),
                    'flag' => $this->resolveUrl($opportunity->flag),
                ]),
        ]);
    }

    private function rules(?Opportunity $opportunity = null): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => [$opportunity?->image ? 'nullable' : 'required', File::image(), 'max:5120'],
            'flag' => ['nullable', File::image(), 'max:2048'],
        ];
    }

    private function uniqueSlug(string $slug): string
    {
        $base = $slug;
        $suffix = 1;

        while (Opportunity::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$suffix++;
        }

        return $slug;
    }

    private function resolveUrl(?string $path): ?string
    {
        if ($path === null) {
            return null;
        }

        return str_starts_with($path, '/') ? $path : request()->root().Storage::url($path);
    }
}
