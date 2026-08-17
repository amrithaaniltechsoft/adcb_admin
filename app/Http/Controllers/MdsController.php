<?php

namespace App\Http\Controllers;

use App\Models\MdsContent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MdsController extends Controller
{
    public const SPECIALTIES = [
        'conservative-dentistry' => 'Conservative Dentistry & Endodontics',
        'orthodontics' => 'Orthodontics & Dentofacial Orthopaedics',
        'prosthodontics' => 'Prosthodontics & Crown and Bridge',
        'oral-surgery' => 'Oral & Maxillofacial Surgery (OMFS)',
        'periodontology' => 'Periodontology',
        'pediatric-dentistry' => 'Pediatric & Preventive Dentistry',
        'oral-medicine' => 'Oral Medicine & Radiology',
        'oral-pathology' => 'Oral & Maxillofacial Pathology',
        'public-health-dentistry' => 'Public Health Dentistry',
    ];

    public const BANNER_IMAGES = [
        'conservative-dentistry' => '/mds/Conservative Dentistry & Endodontics.jpg',
        'orthodontics' => '/mds/Orthodontics & Dentofacial Orthopaedics.jpg',
        'prosthodontics' => '/mds/Prosthodontics & Crown and Bridge.jpg',
        'oral-surgery' => '/mds/Oral & Maxillofacial Surgery.jpg',
        'periodontology' => '/mds/Periodontology.jpg',
        'pediatric-dentistry' => '/mds/Pediatric & Preventive Dentistry.jpg',
        'oral-medicine' => '/mds/Oral Medicine & Radiology.jpg',
        'oral-pathology' => '/mds/Oral Pathology.jpg',
        'public-health-dentistry' => '/mds/Public Health Dentistry.jpg',
    ];

    public function index()
    {
        return view('mds.index', ['specialties' => self::SPECIALTIES]);
    }

    public function data(): JsonResponse
    {
        $contents = MdsContent::latest()->get();

        return response()->json([
            'data' => $contents->map(function (MdsContent $content) {
                return [
                    'id' => $content->id,
                    'title' => $content->title,
                    'slug' => $content->slug,
                    'banner_title' => $content->banner_title,
                    'banner_description' => $content->banner_description,
                    'banner_image' => $content->banner_image,
                    'overview_title' => $content->overview_title,
                    'overview_content' => $content->overview_content,
                    'middle_banner' => $content->middle_banner,
                    'specialties' => $content->specialties,
                    'countries' => $content->countries,
                    'recommendation' => $content->recommendation,
                    'meta_title' => $content->meta_title,
                    'meta_description' => $content->meta_description,
                    'meta_keywords' => $content->meta_keywords,
                    'action' => $this->actionButtons($content),
                ];
            }),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'slug' => ['required', 'string', Rule::in(array_keys(self::SPECIALTIES)), Rule::unique('mds_contents', 'slug')],
            'banner_title' => ['nullable', 'string', 'max:255'],
            'banner_description' => ['nullable', 'string'],
            'overview_title' => ['nullable', 'string', 'max:255'],
            'overview_content' => ['nullable', 'string'],
            'middle_banner' => ['nullable', 'string'],
            'specialties' => ['nullable', 'string'],
            'countries' => ['nullable', 'string'],
            'recommendation' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
        ]);

        MdsContent::create([
            'title' => self::SPECIALTIES[$validated['slug']],
            'slug' => $validated['slug'],
            'banner_image' => self::BANNER_IMAGES[$validated['slug']],
            'banner_title' => $validated['banner_title'] ?? null,
            'banner_description' => $validated['banner_description'] ?? null,
            'overview_title' => $validated['overview_title'] ?? null,
            'overview_content' => $validated['overview_content'] ?? null,
            'middle_banner' => $this->normalizeJson($validated['middle_banner'] ?? null),
            'specialties' => $this->normalizeJson($validated['specialties'] ?? null),
            'countries' => $this->normalizeJson($validated['countries'] ?? null),
            'recommendation' => $this->normalizeJson($validated['recommendation'] ?? null),
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'meta_keywords' => $validated['meta_keywords'] ?? null,
        ]);

        return redirect()->route('mds.index')->with('status', 'MDS content added successfully.');
    }

    public function update(Request $request, MdsContent $mds): RedirectResponse
    {
        $validated = $request->validate([
            'banner_title' => ['nullable', 'string', 'max:255'],
            'banner_description' => ['nullable', 'string'],
            'overview_title' => ['nullable', 'string', 'max:255'],
            'overview_content' => ['nullable', 'string'],
            'middle_banner' => ['nullable', 'string'],
            'specialties' => ['nullable', 'string'],
            'countries' => ['nullable', 'string'],
            'recommendation' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
        ]);

        $mds->update([
            'banner_image' => self::BANNER_IMAGES[$mds->slug],
            'banner_title' => $validated['banner_title'] ?? null,
            'banner_description' => $validated['banner_description'] ?? null,
            'overview_title' => $validated['overview_title'] ?? null,
            'overview_content' => $validated['overview_content'] ?? null,
            'middle_banner' => $this->normalizeJson($validated['middle_banner'] ?? null),
            'specialties' => $this->normalizeJson($validated['specialties'] ?? null),
            'countries' => $this->normalizeJson($validated['countries'] ?? null),
            'recommendation' => $this->normalizeJson($validated['recommendation'] ?? null),
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'meta_keywords' => $validated['meta_keywords'] ?? null,
        ]);

        return redirect()->route('mds.index')->with('status', 'MDS content updated successfully.');
    }

    public function destroy(MdsContent $mds): RedirectResponse
    {
        $mds->delete();

        return back()->with('status', 'MDS content deleted successfully.');
    }

    public function publicIndex()
    {
        return response()->json([
            'data' => MdsContent::orderBy('id')->get()->map(fn (MdsContent $content) => [
                'slug' => $content->slug,
                'title' => $content->title,
                'banner_title' => $content->banner_title,
                'banner_description' => $content->banner_description,
                'overview_content' => $content->overview_content,
                'preview_title' => 'Key Focus Areas',
                'preview_points' => collect($content->specialties ?? [])->first()['highlights'] ?? $content->middle_banner['points'] ?? [],
            ]),
        ]);
    }

    public function publicShow(string $slug): JsonResponse
    {
        $content = MdsContent::where('slug', $slug)->first();

        if (! $content) {
            return response()->json(['message' => 'Not found.'], 404);
        }

        return response()->json(['data' => $content->only([
            'slug',
            'title',
            'banner_title',
            'banner_description',
            'banner_image',
            'overview_title',
            'overview_content',
            'middle_banner',
            'specialties',
            'countries',
            'recommendation',
            'meta_title',
            'meta_description',
            'meta_keywords',
        ])]);
    }

    private function actionButtons(MdsContent $content): string
    {
        $data = 'data-id="'.$content->id.'"'
            .' data-title="'.e($content->title).'"'
            .' data-banner-title="'.e($content->banner_title ?? '').'"'
            .' data-banner-description="'.e($content->banner_description ?? '').'"'
            .' data-overview-title="'.e($content->overview_title ?? '').'"'
            .' data-overview-content="'.e($content->overview_content ?? '').'"'
            .' data-middle-banner="'.e(json_encode($content->middle_banner ?? null)).'"'
            .' data-specialties="'.e(json_encode($content->specialties ?? [])).'"'
            .' data-countries="'.e(json_encode($content->countries ?? [])).'"'
            .' data-recommendation="'.e(json_encode($content->recommendation ?? null)).'"'
            .' data-meta-title="'.e($content->meta_title ?? '').'"'
            .' data-meta-description="'.e($content->meta_description ?? '').'"'
            .' data-meta-keywords="'.e($content->meta_keywords ?? '').'"';

        return '<button type="button" '.$data.' class="btn btn-sm btn-info mr-1 btn-view" title="View"><i class="fas fa-eye"></i></button>'
            .'<button type="button" '.$data.' class="btn btn-sm btn-warning mr-1 btn-edit" title="Edit"><i class="fas fa-edit"></i></button>'
            .'<button type="button" data-id="'.$content->id.'" class="btn btn-sm btn-danger btn-delete" title="Delete"><i class="fas fa-trash"></i></button>';
    }

    private function normalizeJson(?string $value): ?array
    {
        if (blank($value)) {
            return null;
        }

        $decoded = json_decode($value, true);

        return is_array($decoded) ? $decoded : null;
    }
}
