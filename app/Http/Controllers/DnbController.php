<?php

namespace App\Http\Controllers;

use App\Models\DnbContent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DnbController extends Controller
{
    public function index()
    {
        return view('dnb.index', ['dnb' => DnbContent::first()]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'banner_title' => ['nullable', 'string', 'max:255'],
            'banner_description' => ['nullable', 'string'],
            'intro_title' => ['nullable', 'string', 'max:255'],
            'intro_description' => ['nullable', 'string'],
            'specialties' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
        ]);

        DnbContent::create([
            'banner_title' => $validated['banner_title'] ?? null,
            'banner_description' => $validated['banner_description'] ?? null,
            'intro_title' => $validated['intro_title'] ?? null,
            'intro_description' => $validated['intro_description'] ?? null,
            'specialties' => $validated['specialties'] ?? null,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'meta_keywords' => $validated['meta_keywords'] ?? null,
        ]);

        return redirect()->route('dnb.index')->with('status', 'DNB content saved successfully.');
    }

    public function update(Request $request, DnbContent $dnb): RedirectResponse
    {
        $validated = $request->validate([
            'banner_title' => ['nullable', 'string', 'max:255'],
            'banner_description' => ['nullable', 'string'],
            'intro_title' => ['nullable', 'string', 'max:255'],
            'intro_description' => ['nullable', 'string'],
            'specialties' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
        ]);

        $dnb->update([
            'banner_title' => $validated['banner_title'] ?? null,
            'banner_description' => $validated['banner_description'] ?? null,
            'intro_title' => $validated['intro_title'] ?? null,
            'intro_description' => $validated['intro_description'] ?? null,
            'specialties' => $validated['specialties'] ?? null,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'meta_keywords' => $validated['meta_keywords'] ?? null,
        ]);

        return redirect()->route('dnb.index')->with('status', 'DNB content updated successfully.');
    }

    public function publicShow(): JsonResponse
    {
        $dnb = DnbContent::first();

        if (! $dnb) {
            return response()->json(['message' => 'Not found.'], 404);
        }

        return response()->json([
            'data' => [
                'banner_title' => $dnb->banner_title,
                'banner_description' => $dnb->banner_description,
                'intro_title' => $dnb->intro_title,
                'intro_description' => $dnb->intro_description,
                'specialties' => $this->specialtiesArray($dnb),
                'meta_title' => $dnb->meta_title,
                'meta_description' => $dnb->meta_description,
                'meta_keywords' => $dnb->meta_keywords,
            ],
        ]);
    }

    private function specialtiesArray(DnbContent $dnb): array
    {
        if (empty($dnb->specialties)) {
            return [];
        }

        return array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $dnb->specialties)), fn (string $specialty) => $specialty !== ''));
    }
}
