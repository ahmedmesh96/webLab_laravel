<?php

namespace App\Http\Controllers;

use App\Models\Article;

class PublicArticleController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
{
    $query = Article::with(['category', 'tags'])
        ->where('status', 'published')
        ->whereNotNull('published_at')
        ->where('published_at', '<=', now());

    if ($request->filled('search')) {
        $search = $request->input('search');

        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
                ->orWhere('excerpt', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%");
        });
    }

    $articles = $query->latest('published_at')->paginate(9);

    return view('public.articles.index', compact('articles'));
}

    public function show(string $slug)
    {
        $article = Article::with(['author', 'category', 'tags'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->where('slug', $slug)
            ->firstOrFail();

        return view('public.articles.show', compact('article'));
    }
}
