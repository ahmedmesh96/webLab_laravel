<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with(['author', 'category', 'tags'])
            ->latest();

        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('locale')) {
            $query->where('locale', $request->input('locale'));
        }

        $articles = $query->paginate(10)->withQueryString();

        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        $authors = User::orderBy('name')->get();

        return view('articles.create', compact(
            'categories',
            'tags',
            'authors'
        ));
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        $tagIds = $data['tag_ids'] ?? [];
        unset($data['tag_ids'], $data['image_file']);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);

            if ($data['slug'] === '') {
                $data['slug'] = 'article';
            }

            $baseSlug = $data['slug'];
            $counter = 2;

            while (Article::where('slug', $data['slug'])->exists()) {
                $data['slug'] = $baseSlug . '-' . $counter++;
            }
        }

        $userId = \Illuminate\Support\Facades\Auth::user()?->getAuthIdentifier();

$data['author_id'] = $data['author_id'] ?? $userId;

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('image_file')) {
            $data['image'] = $request->file('image_file')
                ->store('articles', 'public');
        }

        $article = Article::create($data);
        $article->tags()->sync($tagIds);

        return redirect()
            ->route('articles.index')
            ->with('success', 'Article created successfully.');
    }

    public function show(Article $article)
    {
        $article->load(['author', 'category', 'tags']);

        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        $authors = User::orderBy('name')->get();

        $article->load('tags');

        return view('articles.edit', compact(
            'article',
            'categories',
            'tags',
            'authors'
        ));
    }

   public function update(Request $request, Article $article)
{
    $data = $this->validatedData($request, $article);

    $tagIds = $data['tag_ids'] ?? [];
    $imageFile = $data['image_file'] ?? null;
    $imageUrl = $data['image'] ?? null;

    unset($data['tag_ids'], $data['image_file']);

    if (empty($data['slug'])) {
        $data['slug'] = Str::slug($data['title']);

        if ($data['slug'] === '') {
            $data['slug'] = 'article';
        }

        $baseSlug = $data['slug'];
        $counter = 2;

        while (
            Article::where('slug', $data['slug'])
                ->where('id', '!=', $article->id)
                ->exists()
        ) {
            $data['slug'] = $baseSlug . '-' . $counter++;
        }
    }

    if (
        $data['status'] === 'published' &&
        empty($data['published_at'])
    ) {
        $data['published_at'] = $article->published_at ?? now();
    }

    $oldImage = $article->image;

    if ($imageFile) {
        $data['image'] = $imageFile->store('articles', 'public');
    } elseif (!empty($imageUrl)) {
        $data['image'] = $imageUrl;
    } else {
        // إذا لم تُرفع صورة جديدة ولم يُدخل رابط، احتفظ بالصورة الحالية.
        unset($data['image']);
    }

    $article->update($data);
    $article->tags()->sync($tagIds);

    $newImage = $article->image;

    if (
        $oldImage &&
        $oldImage !== $newImage &&
        !Str::startsWith($oldImage, ['http://', 'https://'])
    ) {
        Storage::disk('public')->delete($oldImage);
    }

    return redirect()
        ->route('articles.index')
        ->with('success', 'Article updated successfully.');
}

    public function destroy(Article $article)
    {
        $image = $article->image;

        $article->delete();

        if (
            $image &&
            !Str::startsWith($image, ['http://', 'https://'])
        ) {
            Storage::disk('public')->delete($image);
        }

        return redirect()
            ->route('articles.index')
            ->with('success', 'Article deleted successfully.');
    }

    private function validatedData(
        Request $request,
        ?Article $article = null
    ): array {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],

            'slug' => [
                'nullable',
                'string',
                'max:255',
                Rule::unique('articles', 'slug')->ignore($article?->id),
            ],

            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['nullable', 'string'],

            'image' => ['nullable', 'url', 'max:2048'],
            'image_file' => ['nullable', 'image', 'max:5120'],

            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:1000'],

            'status' => ['required', Rule::in(['draft', 'published'])],
            'locale' => ['required', Rule::in(['en', 'ar', 'tr'])],
            'published_at' => ['nullable', 'date'],

            'author_id' => ['nullable', 'integer', 'exists:users,id'],
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],

            'tag_ids' => ['nullable', 'array'],
            'tag_ids.*' => ['integer', 'distinct', 'exists:tags,id'],
        ]);
    }
}
