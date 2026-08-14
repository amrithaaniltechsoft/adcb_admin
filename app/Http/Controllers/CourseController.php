<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\DnbContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class CourseController extends Controller
{
    public function index()
    {
        return view('courses.index');
    }

    public function data()
    {
        $courses = Course::latest()->get();
        $dnb = DnbContent::first();

        return response()->json([
            'data' => $courses->map(function (Course $course) use ($dnb) {
                $isDnb = $course->name === 'DNB';
                $dnbAttrs = '';

                if ($isDnb && $dnb) {
                    $dnbAttrs = ' data-dnb-banner-title="' . e($dnb->banner_title ?? '') . '" data-dnb-banner-description="' . e($dnb->banner_description ?? '') . '" data-dnb-intro-title="' . e($dnb->intro_title ?? '') . '" data-dnb-intro-description="' . e($dnb->intro_description ?? '') . '" data-dnb-specialties="' . e($dnb->specialties ?? '') . '" data-dnb-meta-title="' . e($dnb->meta_title ?? '') . '" data-dnb-meta-description="' . e($dnb->meta_description ?? '') . '" data-dnb-meta-keywords="' . e($dnb->meta_keywords ?? '') . '"';
                }

                $courseAttrs = 'data-id="' . $course->id . '" data-name="' . e($course->name) . '" data-code="' . e($course->code ?? '') . '" data-title="' . e($course->title ?? '') . '" data-description="' . e($course->description ?? '') . '" data-image="' . e($this->resolveUrl($course->image) ?? '') . '" data-href="' . e($course->href ?? '') . '" data-sort-order="' . e($course->sort_order ?? '') . '" data-featured="' . ($course->featured ? '1' : '0') . '"';

                return [
                    'id' => $course->id,
                    'name' => $course->name,
                    'action' => '<button type="button" ' . $courseAttrs . $dnbAttrs . ' class="btn btn-sm btn-info mr-1 btn-view" title="View"><i class="fas fa-eye"></i></button>' .
                        '<button type="button" ' . $courseAttrs . $dnbAttrs . ' class="btn btn-sm btn-warning mr-1 btn-edit" title="Edit"><i class="fas fa-edit"></i></button>',
                ];
            }),
        ]);
    }

    public function update(Request $request, Course $course): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['nullable', 'string', 'max:255'],
            'title' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', File::image(), 'max:5120'],
            'href' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer'],
            'featured' => ['nullable', 'boolean'],
        ]);

        $validated['featured'] = $request->boolean('featured');

        if ($request->hasFile('image')) {
            if ($course->image && ! str_starts_with($course->image, '/')) {
                Storage::disk('public')->delete($course->image);
            }

            $validated['image'] = $request->file('image')->store('courses', 'public');
        }

        $course->update($validated);

        if ($course->name === 'DNB') {
            $dnbValidated = $request->validate([
                'banner_title' => ['nullable', 'string', 'max:255'],
                'banner_description' => ['nullable', 'string'],
                'intro_title' => ['nullable', 'string', 'max:255'],
                'intro_description' => ['nullable', 'string'],
                'specialties' => ['nullable', 'string'],
                'meta_title' => ['nullable', 'string', 'max:255'],
                'meta_description' => ['nullable', 'string'],
                'meta_keywords' => ['nullable', 'string'],
            ]);

            $dnb = DnbContent::first();

            if ($dnb) {
                $dnb->update([
                    'banner_title' => $dnbValidated['banner_title'] ?? null,
                    'banner_description' => $dnbValidated['banner_description'] ?? null,
                    'intro_title' => $dnbValidated['intro_title'] ?? null,
                    'intro_description' => $dnbValidated['intro_description'] ?? null,
                    'specialties' => $dnbValidated['specialties'] ?? null,
                    'meta_title' => $dnbValidated['meta_title'] ?? null,
                    'meta_description' => $dnbValidated['meta_description'] ?? null,
                    'meta_keywords' => $dnbValidated['meta_keywords'] ?? null,
                ]);
            } else {
                DnbContent::create([
                    'banner_title' => $dnbValidated['banner_title'] ?? null,
                    'banner_description' => $dnbValidated['banner_description'] ?? null,
                    'intro_title' => $dnbValidated['intro_title'] ?? null,
                    'intro_description' => $dnbValidated['intro_description'] ?? null,
                    'specialties' => $dnbValidated['specialties'] ?? null,
                    'meta_title' => $dnbValidated['meta_title'] ?? null,
                    'meta_description' => $dnbValidated['meta_description'] ?? null,
                    'meta_keywords' => $dnbValidated['meta_keywords'] ?? null,
                ]);
            }
        }

        return redirect()->route('courses.index')->with('status', 'Course updated successfully.');
    }

    public function publicIndex()
    {
        return response()->json([
            'data' => Course::orderBy('sort_order')->orderBy('id')->get()->map(fn (Course $course) => [
                'id' => $course->id,
                'name' => $course->name,
                'code' => $course->code,
                'title' => $course->title,
                'description' => $course->description,
                'image' => $this->resolveUrl($course->image),
                'href' => $course->href,
                'sort_order' => $course->sort_order,
                'featured' => $course->featured,
            ]),
        ]);
    }

    private function resolveUrl(?string $path): ?string
    {
        if ($path === null) {
            return null;
        }

        return str_starts_with($path, '/') ? $path : request()->root().Storage::url($path);
    }
}
