<?php

namespace App\Http\Controllers;

use App\Http\Resources\FaqResource;
use App\Models\Faq;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FaqController extends Controller
{
    public function index()
    {
        return view('faqs.index');
    }

    public function data()
    {
        $faqs = Faq::latest()->get();

        return response()->json([
            'data' => $faqs->map(function (Faq $faq) {
                return [
                    'id' => $faq->id,
                    'category' => $faq->category,
                    'question' => $faq->question,
                    'answer' => $faq->answer,
                    'action' => '<button type="button" data-id="' . $faq->id . '" class="btn btn-sm btn-info mr-1 btn-view" title="View"><i class="fas fa-eye"></i></button>' .
                        '<button type="button" data-id="' . $faq->id . '" data-category="' . e($faq->category) . '" data-question="' . e($faq->question) . '" data-answer="' . e($faq->answer) . '" class="btn btn-sm btn-warning mr-1 btn-edit" title="Edit"><i class="fas fa-edit"></i></button>' .
                        '<button type="button" data-id="' . $faq->id . '" class="btn btn-sm btn-danger btn-delete" title="Delete"><i class="fas fa-trash"></i></button>',
                ];
            }),
        ]);
    }

    public function publicIndex(Request $request): AnonymousResourceCollection
    {
        return FaqResource::collection(
            Faq::query()
                ->when($request->filled('category'), fn ($query) => $query->where('category', $request->string('category')))
                ->orderByDesc('id')
                ->get()
        );
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category' => ['nullable', 'string'],
            'question' => ['required', 'string'],
            'answer' => ['required', 'string'],
        ]);

        Faq::create($validated);

        return back()->with('status', 'FAQ saved successfully.');
    }

    public function update(Request $request, Faq $faq): RedirectResponse
    {
        $validated = $request->validate([
            'category' => ['nullable', 'string'],
            'question' => ['required', 'string'],
            'answer' => ['required', 'string'],
        ]);

        $faq->update($validated);

        return redirect()->route('faqs.index')->with('status', 'FAQ updated successfully.');
    }

    public function destroy(Faq $faq): RedirectResponse
    {
        $faq->delete();

        return back()->with('status', 'FAQ deleted successfully.');
    }
}
