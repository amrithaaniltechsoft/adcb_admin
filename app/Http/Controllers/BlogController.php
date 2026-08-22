<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        return view('blogs.index');
    }

    public function data()
    {
        $blogs = Blog::latest()->get();

        return response()->json([
            'data' => $blogs->map(function (Blog $blog) {
                return [
                    'id' => $blog->id,
                    'title' => $blog->title,
                    'slug' => $blog->slug,
                    'date' => $blog->date,
                    'image' => $blog->image,
                    'action' => '<button type="button" data-id="'.$blog->id.'" class="btn btn-sm btn-info mr-1 btn-view" title="View"><i class="fas fa-eye"></i></button>'.
                        '<button type="button" data-id="'.$blog->id.'" class="btn btn-sm btn-warning mr-1 btn-edit" title="Edit"><i class="fas fa-edit"></i></button>'.
                        '<button type="button" data-id="'.$blog->id.'" class="btn btn-sm btn-danger btn-delete" title="Delete"><i class="fas fa-trash"></i></button>',
                ];
            }),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateBlog($request);

        if ($request->hasFile('image')) {
            $validated['image'] = '/storage/'.$request->file('image')->store('blogs', 'public');
        } else {
            unset($validated['image']);
        }

        Blog::create($validated);

        return redirect()->route('blogs.index')->with('status', 'Blog created successfully.');
    }

    public function update(Request $request, Blog $blog): RedirectResponse
    {
        $validated = $this->validateBlog($request, $blog->id);

        if ($request->hasFile('image')) {
            $validated['image'] = '/storage/'.$request->file('image')->store('blogs', 'public');
        } else {
            unset($validated['image']);
        }

        $blog->update($validated);

        return redirect()->route('blogs.index')->with('status', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog): RedirectResponse
    {
        $blog->delete();

        return back()->with('status', 'Blog deleted successfully.');
    }

    public function publicIndex(): JsonResponse
    {
        $blogs = Blog::orderByDesc('id')->get();

        return response()->json([
            'data' => $blogs->map(fn (Blog $blog) => $this->transform($blog)),
        ]);
    }

    public function publicShow(string $slug): JsonResponse
    {
        $blog = Blog::where('slug', $slug)->first();

        if (! $blog) {
            return response()->json(['message' => 'Not found.'], 404);
        }

        return response()->json(['data' => $this->transform($blog)]);
    }

    private function validateBlog(Request $request, ?int $ignoreId = null): array
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:blogs,slug'.($ignoreId ? ",{$ignoreId}" : '')],
            'excerpt' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
            'category' => ['nullable', 'string', 'max:255'],
            'date' => ['nullable', 'string', 'max:255'],
            'read_time' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif,svg', 'max:4096'],
            'tags' => ['nullable', 'string'],
            'author' => ['nullable', 'string', 'max:255'],
        ]);

        $validated['slug'] = $this->uniqueSlug(
            $validated['slug'] ?? ($validated['title'] ?? ''),
            $ignoreId
        );

        return $validated;
    }

    private function uniqueSlug(string $source, ?int $ignoreId = null): string
    {
        $base = Str::slug($source !== '' ? $source : 'blog-post');
        $slug = $base;
        $counter = 2;

        while (Blog::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base.'-'.$counter++;
        }

        return $slug;
    }

    private function transform(Blog $blog): array
    {
        return [
            'id' => $blog->id,
            'slug' => $blog->slug,
            'title' => $blog->title,
            'excerpt' => $blog->excerpt,
            'content' => $blog->content,
            'category' => $blog->category,
            'date' => $blog->date,
            'read_time' => $blog->read_time,
            'image' => $this->imageUrl($blog->image),
            'tags' => $this->tagsArray($blog),
            'author' => $blog->author,
        ];
    }

    private function imageUrl(?string $image): ?string
    {
        if (! $image) {
            return null;
        }

        // Uploaded files live on this backend; serve them as absolute URLs.
        if (Str::startsWith($image, ['storage/', '/storage'])) {
            return asset(Str::startsWith($image, '/storage') ? $image : '/'.$image);
        }

        return $image;
    }

    private function tagsArray(Blog $blog): array
    {
        if (empty($blog->tags)) {
            return [];
        }

        return array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n|,/', $blog->tags)), fn (string $tag) => $tag !== ''));
    }
}
