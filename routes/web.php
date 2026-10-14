<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PublicArticleController;
use App\Http\Controllers\PublicHomeController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

// Redirect the root URL to the default language.
Route::get('/', function () {
    return redirect('/en');
});

// Localized public homepages.
Route::get('/{locale}', [PublicHomeController::class, 'index'])
    ->where('locale', 'en|ar|tr')
    ->name('public.home');

// Existing public blog.
Route::get('/blog', [PublicArticleController::class, 'index'])
    ->name('public.articles.index');

Route::get('/blog/{slug}', [PublicArticleController::class, 'show'])
    ->name('public.articles.show');

// Localized blog URLs.
Route::get('/{locale}/blog', function (string $locale) {
    abort_unless(in_array($locale, ['en', 'ar', 'tr'], true), 404);

    return app(PublicArticleController::class)->index(
        request()->merge(['locale' => $locale])
    );
})->where('locale', 'en|ar|tr')
  ->name('public.localized-articles.index');

Route::get('/{locale}/blog/{slug}', function (string $locale, string $slug) {
    abort_unless(in_array($locale, ['en', 'ar', 'tr'], true), 404);

    $article = \App\Models\Article::query()
        ->where('locale', $locale)
        ->where('slug', $slug)
        ->where('status', 'published')
        ->whereNotNull('published_at')
        ->where('published_at', '<=', now())
        ->firstOrFail();

    return view('public.articles.show', compact('article'));
})->where('locale', 'en|ar|tr')
  ->name('public.localized-articles.show');

// Dashboard.
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Protected routes - login required.
Route::middleware('auth')->group(function () {

    // Profile.
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Project Management.
    Route::resource('projects', ProjectController::class);

    // Article Management.
    Route::resource('articles', ArticleController::class);

    // Service Management.
    Route::resource('services', ServiceController::class)->except(['show']);
});

require __DIR__.'/auth.php';
