<?php

namespace App\Http\Controllers;

use App\Models\MdmsContent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MdmsController extends Controller
{
    public const STATES = [
        'kerala' => 'Kerala',
        'tamil-nadu' => 'Tamil Nadu',
        'karnataka' => 'Karnataka',
        'andhra-pradesh' => 'Andhra Pradesh',
        'telangana' => 'Telangana',
        'pondicherry' => 'Pondicherry',
        'haryana' => 'Haryana',
        'punjab' => 'Punjab',
        'himachal-pradesh' => 'Himachal Pradesh',
        'uttar-pradesh' => 'Uttar Pradesh',
        'bihar' => 'Bihar',
        'chhattisgarh' => 'Chhattisgarh',
        'west-bengal' => 'West Bengal',
        'uttarakhand' => 'Uttarakhand',
    ];

    public function index()
    {
        return view('mdms.index', ['states' => self::STATES]);
    }

    public function data(): JsonResponse
    {
        $contents = MdmsContent::orderBy('state_slug')->get();

        return response()->json([
            'data' => $contents->map(function (MdmsContent $content) {
                $state = ucwords(str_replace('-', ' ', $content->state_slug));

                return [
                    'id' => $content->id,
                    'state' => $state,
                    'state_slug' => $content->state_slug,
                    'banner_title' => $content->banner_title,
                    'banner_description' => $content->banner_description,
                    'meta_title' => $content->meta_title,
                    'meta_description' => $content->meta_description,
                    'meta_keywords' => $content->meta_keywords,
                    'title' => $content->title,
                    'subtitle' => $content->subtitle,
                    'intro' => $content->intro,
                    'sections' => $content->sections,
                    'action' => $this->actionButtons($content),
                ];
            }),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'state_slug' => ['required', 'string', Rule::in(array_keys(self::STATES)), Rule::unique('mdms_contents', 'state_slug')],
            'banner_title' => ['nullable', 'string', 'max:255'],
            'banner_description' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'intro' => ['nullable', 'string'],
            'sections' => ['nullable', 'array'],
            'sections.*.id' => ['nullable', 'string', 'max:255'],
            'sections.*.label' => ['nullable', 'string', 'max:255'],
            'sections.*.questions' => ['nullable', 'string'],
        ]);

        MdmsContent::create([
            'state_slug' => $validated['state_slug'],
            'banner_title' => $validated['banner_title'] ?? null,
            'banner_description' => $validated['banner_description'] ?? null,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'meta_keywords' => $validated['meta_keywords'] ?? null,
            'title' => $validated['title'] ?? null,
            'subtitle' => $validated['subtitle'] ?? null,
            'intro' => $validated['intro'] ?? null,
            'sections' => $this->normalizeSections($validated['sections'] ?? []),
        ]);

        return redirect()->route('mdms.index')->with('status', 'MD/MS content added successfully.');
    }

    public function update(Request $request, MdmsContent $mdms): RedirectResponse
    {
        $validated = $request->validate([
            'banner_title' => ['nullable', 'string', 'max:255'],
            'banner_description' => ['nullable', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
            'title' => ['nullable', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'intro' => ['nullable', 'string'],
            'sections' => ['nullable', 'array'],
            'sections.*.id' => ['nullable', 'string', 'max:255'],
            'sections.*.label' => ['nullable', 'string', 'max:255'],
            'sections.*.questions' => ['nullable', 'string'],
        ]);

        $mdms->update([
            'banner_title' => $validated['banner_title'] ?? null,
            'banner_description' => $validated['banner_description'] ?? null,
            'meta_title' => $validated['meta_title'] ?? null,
            'meta_description' => $validated['meta_description'] ?? null,
            'meta_keywords' => $validated['meta_keywords'] ?? null,
            'title' => $validated['title'] ?? null,
            'subtitle' => $validated['subtitle'] ?? null,
            'intro' => $validated['intro'] ?? null,
            'sections' => $this->normalizeSections($validated['sections'] ?? []),
        ]);

        return redirect()->route('mdms.index')->with('status', 'MD/MS content updated successfully.');
    }

    public function destroy(MdmsContent $mdms): RedirectResponse
    {
        $mdms->delete();

        return redirect()->route('mdms.index')->with('status', 'MD/MS content deleted successfully.');
    }

    public function publicIndex(): JsonResponse
    {
        return response()->json([
            'data' => MdmsContent::orderBy('state_slug')->get()->map(function (MdmsContent $content) {
                $firstSection = $content->sections[0] ?? [];

                return [
                    'state' => ucwords(str_replace('-', ' ', $content->state_slug)),
                    'slug' => $content->state_slug,
                    'banner_title' => $content->banner_title,
                    'banner_description' => $content->banner_description,
                    'preview_title' => $firstSection['label'] ?? null,
                    'preview_points' => $firstSection['questions'] ?? [],
                ];
            }),
        ]);
    }

    public function publicShow(string $state): JsonResponse
    {
        $content = MdmsContent::where('state_slug', $state)->first();

        if (! $content) {
            return response()->json(['message' => 'Not found.'], 404);
        }

        return response()->json(['data' => $content->only(['state_slug', 'banner_title', 'banner_description', 'meta_title', 'meta_description', 'meta_keywords', 'title', 'subtitle', 'intro', 'sections'])]);
    }

    private function actionButtons(MdmsContent $content): string
    {
        $data = 'data-id="'.$content->id.'"'
            .' data-state="'.e(ucwords(str_replace('-', ' ', $content->state_slug))).'"'
            .' data-banner-title="'.e($content->banner_title ?? '').'"'
            .' data-banner-description="'.e($content->banner_description ?? '').'"'
            .' data-meta-title="'.e($content->meta_title ?? '').'"'
            .' data-meta-description="'.e($content->meta_description ?? '').'"'
            .' data-meta-keywords="'.e($content->meta_keywords ?? '').'"'
            .' data-title="'.e($content->title ?? '').'"'
            .' data-subtitle="'.e($content->subtitle ?? '').'"'
            .' data-intro="'.e($content->intro ?? '').'"'
            .' data-sections="'.e(json_encode($content->sections ?? [])).'"';

        return '<button type="button" '.$data.' class="btn btn-sm btn-info mr-1 btn-view" title="View"><i class="fas fa-eye"></i></button>'
            .'<button type="button" '.$data.' class="btn btn-sm btn-warning mr-1 btn-edit" title="Edit"><i class="fas fa-edit"></i></button>'
            .'<button type="button" data-id="'.$content->id.'" class="btn btn-sm btn-danger btn-delete" title="Delete"><i class="fas fa-trash"></i></button>';
    }

    /**
     * @param  array<int, array<string, string>>  $sections
     * @return array<int, array{id: string, label: string, questions: array<int, string>}>
     */
    private function normalizeSections(array $sections): array
    {
        $normalized = [];

        foreach ($sections as $section) {
            $questions = $section['questions'] ?? '';
            $questionList = array_values(array_filter(
                array_map('trim', preg_split('/\r\n|\r|\n/', (string) $questions)),
                fn (string $question) => $question !== ''
            ));

            $normalized[] = [
                'id' => $section['id'] ?? '',
                'label' => $section['label'] ?? '',
                'questions' => $questionList,
            ];
        }

        return $normalized;
    }
}
