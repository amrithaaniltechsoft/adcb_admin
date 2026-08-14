<?php

namespace App\Http\Controllers;

use App\Http\Resources\SeoMetaResource;
use App\Models\SeoMeta;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SeoMetaController extends Controller
{
    public function index()
    {
        return view('seo-metas.index');
    }

    public function data()
    {
        $seoMetas = SeoMeta::latest()->get();

        return response()->json([
            'data' => $seoMetas->map(function (SeoMeta $seoMeta) {
                return [
                    'id' => $seoMeta->id,
                    'page_name' => $seoMeta->page_name,
                    'meta_title' => $seoMeta->meta_title,
                    'meta_description' => $seoMeta->meta_description,
                    'meta_keywords' => $seoMeta->meta_keywords,
                    'action' => '<button type="button" data-id="' . $seoMeta->id . '" class="btn btn-sm btn-info mr-1 btn-view" title="View"><i class="fas fa-eye"></i></button>' .
                        '<button type="button" data-id="' . $seoMeta->id . '" class="btn btn-sm btn-warning mr-1 btn-edit" title="Edit"><i class="fas fa-edit"></i></button>' .
                        '<button type="button" data-id="' . $seoMeta->id . '" class="btn btn-sm btn-danger btn-delete" title="Delete"><i class="fas fa-trash"></i></button>',
                ];
            }),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'page_name' => ['required', 'string', 'max:255', 'unique:seo_metas,page_name'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
        ]);

        SeoMeta::create($validated);

        return back()->with('status', 'SEO meta saved successfully.');
    }

    public function update(Request $request, SeoMeta $seoMeta): RedirectResponse
    {
        $validated = $request->validate([
            'page_name' => ['required', 'string', 'max:255', 'unique:seo_metas,page_name,'.$seoMeta->id],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'meta_keywords' => ['nullable', 'string'],
        ]);

        $seoMeta->update($validated);

        return redirect()->route('seo-metas.index')->with('status', 'SEO meta updated successfully.');
    }

    public function destroy(SeoMeta $seoMeta): RedirectResponse
    {
        $seoMeta->delete();

        return back()->with('status', 'SEO meta deleted successfully.');
    }

    public function publicIndex(Request $request): AnonymousResourceCollection
    {
        return SeoMetaResource::collection(
            SeoMeta::query()
                ->when($request->filled('page'), fn ($query) => $query->where('page_name', $request->string('page')))
                ->orderBy('page_name')
                ->get()
        );
    }
}
