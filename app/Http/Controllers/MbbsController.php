<?php

namespace App\Http\Controllers;

use App\Models\MbbsContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MbbsController extends Controller
{
    public const STATES = [
        'tamil-nadu' => 'Tamil Nadu',
        'kerala' => 'Kerala',
        'karnataka' => 'Karnataka',
        'pondicherry' => 'Pondicherry',
        'telangana' => 'Telangana',
        'andhra-pradesh' => 'Andhra Pradesh',
        'haryana' => 'Haryana',
        'punjab' => 'Punjab',
        'himachal-pradesh' => 'Himachal Pradesh',
        'uttar-pradesh' => 'Uttar Pradesh',
        'bihar' => 'Bihar',
    ];

    public function index()
    {
        return view('mbbs.index', ['states' => self::STATES]);
    }

    public function data()
    {
        $contents = MbbsContent::latest()->get();

        return response()->json([
            'data' => $contents->map(function (MbbsContent $content) {
                return [
                    'id' => $content->id,
                    'state' => $content->state,
                    'slug' => $content->slug,
                'banner_title' => $content->banner_title,
                'banner_description' => $content->banner_description,
                'banner_image' => $content->banner_image,
                'preview_title' => $content->preview_title,
                    'preview_points' => $content->preview_points,
                    'content' => $content->content,
                    'meta_title' => $content->meta_title,
                    'meta_description' => $content->meta_description,
                    'meta_keywords' => $content->meta_keywords,
                    'action' => '<button type="button" data-id="' . $content->id . '" class="btn btn-sm btn-info mr-1 btn-view" title="View"><i class="fas fa-eye"></i></button>' .
                        '<button type="button" data-id="' . $content->id . '" data-state="' . e($content->state) . '" data-banner-title="' . e($content->banner_title ?? '') . '" data-banner-description="' . e($content->banner_description ?? '') . '" data-preview-title="' . e($content->preview_title ?? '') . '" data-preview-points="' . e($content->preview_points ?? '') . '" data-content="' . e($content->content ?? '') . '" data-meta-title="' . e($content->meta_title ?? '') . '" data-meta-description="' . e($content->meta_description ?? '') . '" data-meta-keywords="' . e($content->meta_keywords ?? '') . '" class="btn btn-sm btn-warning mr-1 btn-edit" title="Edit"><i class="fas fa-edit"></i></button>' .
                        '<button type="button" data-id="' . $content->id . '" class="btn btn-sm btn-danger btn-delete" title="Delete"><i class="fas fa-trash"></i></button>',
                ];
            }),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'slug' => ['required', 'string', Rule::in(array_keys(self::STATES)), Rule::unique('mbbs_contents', 'slug')],
            'banner_title' => ['nullable', 'string', 'max:255'],
            'banner_description' => ['nullable', 'string'],
            'preview_title' => ['nullable', 'string', 'max:255'],
            'preview_points' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
        ]);

        MbbsContent::create([
            'slug' => $validated['slug'],
            'state' => self::STATES[$validated['slug']],
            'banner_title' => $validated['banner_title'] ?? null,
            'banner_description' => $validated['banner_description'] ?? null,
            'preview_title' => $validated['preview_title'] ?? null,
            'preview_points' => $validated['preview_points'] ?? null,
            'content' => $validated['content'] ?? null,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'meta_keywords' => $validated['meta_keywords'] ?? null,
        ]);

        return back()->with('status', 'MBBS content added successfully.');
    }

    public function update(Request $request, MbbsContent $mbbs): RedirectResponse
    {
        $validated = $request->validate([
            'banner_title' => ['nullable', 'string', 'max:255'],
            'banner_description' => ['nullable', 'string'],
            'preview_title' => ['nullable', 'string', 'max:255'],
            'preview_points' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
        ]);

        $mbbs->update([
            'banner_title' => $validated['banner_title'] ?? null,
            'banner_description' => $validated['banner_description'] ?? null,
            'preview_title' => $validated['preview_title'] ?? null,
            'preview_points' => $validated['preview_points'] ?? null,
            'content' => $validated['content'] ?? null,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'meta_keywords' => $validated['meta_keywords'] ?? null,
        ]);

        return redirect()->route('mbbs.index')->with('status', 'MBBS content updated successfully.');
    }

    public function destroy(MbbsContent $mbbs): RedirectResponse
    {
        $mbbs->delete();

        return back()->with('status', 'MBBS content deleted successfully.');
    }

    public function publicIndex()
    {
        $contents = MbbsContent::get()->keyBy('slug');

        $ordered = collect(array_keys(self::STATES))
            ->map(fn (string $slug) => $contents->get($slug))
            ->filter()
            ->values();

        return response()->json([
            'data' => $ordered->map(fn (MbbsContent $content) => [
                'state' => $content->state,
                'slug' => $content->slug,
                'banner_title' => $content->banner_title,
                'banner_description' => $content->banner_description,
                'preview_title' => $content->preview_title,
                'preview_points' => $this->previewPointsArray($content),
            ]),
        ]);
    }

    private function previewPointsArray(MbbsContent $content): array
    {
        if (empty($content->preview_points)) {
            return [];
        }

        return array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $content->preview_points)), fn (string $point) => $point !== ''));
    }

    public function publicShow(string $slug)
    {
        $content = MbbsContent::where('slug', $slug)->first();

        if (! $content) {
            return response()->json(['message' => 'Not found.'], 404);
        }

        return response()->json([
            'data' => [
                'state' => $content->state,
                'slug' => $content->slug,
                'banner_title' => $content->banner_title,
                'banner_description' => $content->banner_description,
                'banner_image' => $content->banner_image,
                'preview_title' => $content->preview_title,
                'preview_points' => $this->previewPointsArray($content),
                'content' => $content->content,
                'meta_title' => $content->meta_title,
                'meta_description' => $content->meta_description,
                'meta_keywords' => $content->meta_keywords,
            ],
        ]);
    }
}
