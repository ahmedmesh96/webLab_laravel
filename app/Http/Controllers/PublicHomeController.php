<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Project;
use App\Models\Service;
use Illuminate\View\View;

class PublicHomeController extends Controller
{
    public function index(string $locale = 'en'): View
    {
        abort_unless(in_array($locale, ['en', 'ar', 'tr'], true), 404);

        $services = Service::query()
            ->where('status', 'published')
            ->with(['translations' => function ($query) use ($locale) {
                $query->where('locale', $locale)
                    ->where('status', 'published');
            }])
            ->latest()
            ->take(4)
            ->get();

        $projects = Project::query()
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        $articles = Article::query()
            ->where('status', 'published')
            ->where('locale', $locale)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('public.home', compact(
            'locale',
            'services',
            'projects',
            'articles'
        ));
    }
}
