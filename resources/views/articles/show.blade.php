<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }} | WebLabStudios</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            margin: 0;
            background: #f6f6f2;
            color: #171717;
            font-family: Arial, Helvetica, sans-serif;
        }
        .layout { display: flex; min-height: 100vh; }
        .sidebar {
            width: 230px;
            flex-shrink: 0;
            background: #111;
            color: white;
            padding: 28px 20px;
            box-sizing: border-box;
        }
        .brand { font-size: 21px; font-weight: 800; margin-bottom: 40px; }
        .brand span { color: #c6ff5e; }
        .nav a {
            display: block;
            color: #ccc;
            text-decoration: none;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 5px;
        }
        .nav a:hover, .nav a.active { background: #c6ff5e; color: #111; }
        .main { flex: 1; min-width: 0; padding: 36px; }
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            margin-bottom: 28px;
        }
        .muted { color: #777; font-size: 14px; }
        .btn {
            display: inline-block;
            padding: 11px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 700;
            font-size: 14px;
            border: 0;
            cursor: pointer;
        }
        .btn-dark { background: #111; color: white; }
        .btn-lime { background: #c6ff5e; color: #111; }
        .card {
            background: white;
            border: 1px solid #e8e8e2;
            border-radius: 16px;
            padding: 28px;
            margin-bottom: 20px;
        }
        h1 { font-size: clamp(28px, 4vw, 42px); margin: 10px 0 16px; }
        h2 { font-size: 20px; margin-top: 0; }
        .meta { display: flex; flex-wrap: wrap; gap: 10px; margin: 18px 0; }
        .pill {
            display: inline-block;
            background: #f0f0eb;
            padding: 7px 11px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }
        .cover {
            display: block;
            width: 100%;
            max-height: 420px;
            object-fit: cover;
            border-radius: 12px;
            margin: 22px 0;
        }
        .excerpt { font-size: 18px; line-height: 1.7; color: #555; }
        .content { line-height: 1.9; overflow-wrap: anywhere; }
        .content p { margin: 0 0 18px; }
        .actions { display: flex; gap: 10px; flex-wrap: wrap; }
        .tag {
            display: inline-block;
            border: 1px solid #ddd;
            border-radius: 20px;
            padding: 7px 11px;
            margin: 3px;
            font-size: 13px;
        }
        @media (max-width: 760px) {
            .layout { display: block; }
            .sidebar { width: 100%; padding: 18px; }
            .brand { margin-bottom: 15px; }
            .nav { display: flex; flex-wrap: wrap; gap: 4px; }
            .nav a { padding: 9px; }
            .main { padding: 20px 14px; }
            .card { padding: 20px; }
        }
    </style>
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <div class="brand">WebLab<span>Studios</span></div>
        <nav class="nav">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('projects.index') }}">Projects</a>
            <a href="{{ route('articles.index') }}" class="active">Articles</a>
            <a href="{{ route('profile.edit') }}">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn" style="color:#ccc;background:transparent;padding:12px;">
                    Log out
                </button>
            </form>
        </nav>
    </aside>

    <main class="main">
        <div class="topbar">
            <div>
                <div class="muted">CONTENT MANAGEMENT / ARTICLES</div>
                <h1>{{ $article->title }}</h1>
                <div class="muted">Article details and publishing information</div>
            </div>
            <div class="actions">
                <a href="{{ route('articles.index') }}" class="btn btn-dark">← All Articles</a>
                <a href="{{ route('articles.edit', $article) }}" class="btn btn-lime">Edit Article</a>
            </div>
        </div>

        <section class="card">
            <div class="meta">
                <span class="pill">{{ ucfirst($article->status) }}</span>
                <span class="pill">{{ strtoupper($article->locale) }}</span>
                @if($article->category)
                    <span class="pill">{{ $article->category->name }}</span>
                @endif
            </div>

            <div class="muted">
                Slug: {{ $article->slug }}
                · Author: {{ $article->author?->name ?? 'Unassigned' }}
                · Updated: {{ $article->updated_at?->format('M d, Y') ?? '—' }}
            </div>

            @if($article->image)
                <img
                    class="cover"
                    src="{{ \Illuminate\Support\Str::startsWith($article->image, ['http://', 'https://']) ? $article->image : \Illuminate\Support\Facades\Storage::disk('public')->url($article->image) }}"
                    alt="{{ $article->title }}"
                >
            @endif

            @if($article->excerpt)
                <p class="excerpt">{{ $article->excerpt }}</p>
            @endif
        </section>

        <section class="card">
            <h2>Article Content</h2>
            <div class="content">{{ $article->content ?: 'No article content has been added yet.' }}</div>
        </section>

        <section class="card">
            <h2>SEO Information</h2>
            <p><strong>Meta title:</strong> {{ $article->meta_title ?: 'Not set' }}</p>
            <p><strong>Meta description:</strong> {{ $article->meta_description ?: 'Not set' }}</p>
            <p><strong>Published at:</strong>
                {{ $article->published_at?->format('M d, Y H:i') ?? 'Not published' }}
            </p>
        </section>

        <section class="card">
            <h2>Tags</h2>
            @forelse($article->tags as $tag)
                <span class="tag">{{ $tag->name }}</span>
            @empty
                <p class="muted">No tags assigned to this article.</p>
            @endforelse
        </section>
    </main>
</div>
</body>
</html>
