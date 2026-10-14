<!DOCTYPE html>
<html lang="{{ $article->locale === 'ar' ? 'ar' : ($article->locale === 'tr' ? 'tr' : 'en') }}"
    dir="{{ $article->locale === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $article->meta_title ?: $article->title }} | WebLabStudios</title>

    <meta name="description"
        content="{{ $article->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($article->excerpt ?: $article->content), 160) }}">

    <meta name="robots" content="index, follow">

    <link rel="canonical" href="{{ url('/blog/' . $article->slug) }}">

    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ $article->meta_title ?: $article->title }}">
    <meta property="og:description"
        content="{{ $article->meta_description ?: \Illuminate\Support\Str::limit(strip_tags($article->excerpt ?: $article->content), 160) }}">
    <meta property="og:url" content="{{ url('/blog/' . $article->slug) }}">

    @if ($article->image)
        <meta property="og:image"
            content="{{ \Illuminate\Support\Str::startsWith($article->image, ['http://', 'https://']) ? $article->image : \Illuminate\Support\Facades\Storage::disk('public')->url($article->image) }}">
    @endif

    @if ($article->published_at)
        <meta property="article:published_time" content="{{ $article->published_at->toIso8601String() }}">
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])

   <style>
    :root {
        --ink: #171814;
        --paper: #f8f8f4;
        --white: #fff;
        --lime: #c6ff5e;
        --muted: #73756c;
        --line: #e6e7df;
        --reading-width: 760px;
    }

    * {
        box-sizing: border-box;
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        margin: 0;
        color: var(--ink);
        background: var(--paper);
        font-family: Inter, Arial, Helvetica, sans-serif;
        -webkit-font-smoothing: antialiased;
    }

    a {
        color: inherit;
        text-decoration: none;
    }

    img {
        max-width: 100%;
    }

    .container {
        width: min(1120px, calc(100% - 44px));
        margin-inline: auto;
    }

    .navbar {
        color: white;
        background: var(--ink);
        border-bottom: 1px solid #34352f;
    }

    .nav-inner {
        min-height: 76px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
    }

    .logo {
        font-size: 21px;
        font-weight: 900;
        letter-spacing: -1px;
    }

    .logo span {
        color: var(--lime);
    }

    .nav-links {
        display: flex;
        align-items: center;
        gap: 26px;
        color: #d1d2ca;
        font-size: 14px;
    }

    .nav-links a:hover {
        color: var(--lime);
    }

    .nav-cta {
        background: var(--lime);
        color: var(--ink);
        padding: 12px 16px;
        border-radius: 6px;
        font-weight: 800;
    }

    .article-header {
        padding: 66px 0 38px;
        background: var(--paper);
    }

    .header-inner {
        max-width: 900px;
        margin-inline: auto;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 38px;
        font-size: 13px;
        font-weight: 800;
        color: #55574f;
    }

    .back-link:hover {
        color: #54771a;
    }

    .eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        color: #587b20;
        text-transform: uppercase;
        letter-spacing: 1.8px;
        font-size: 11px;
        font-weight: 900;
    }

    .eyebrow::before {
        content: "";
        display: inline-block;
        width: 22px;
        height: 2px;
        background: var(--lime);
    }

    h1 {
        font-size: clamp(38px, 6.3vw, 68px);
        line-height: 1.08;
        letter-spacing: -2.8px;
        margin: 22px 0;
        overflow-wrap: anywhere;
    }

    .article-excerpt {
        max-width: 760px;
        color: #66685f;
        font-size: clamp(17px, 2vw, 21px);
        line-height: 1.8;
        margin: 0;
    }

    .article-meta {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 28px;
        color: var(--muted);
        font-size: 13px;
    }

    .category {
        display: inline-block;
        color: #3f581b;
        background: #eaf6d8;
        border-radius: 4px;
        padding: 7px 10px;
        font-size: 12px;
        font-weight: 800;
    }

    .meta-dot {
        width: 4px;
        height: 4px;
        background: #a3a59c;
        border-radius: 50%;
    }

    .cover-section {
        padding: 0 0 48px;
    }

    .cover {
        display: block;
        width: 100%;
        max-height: 620px;
        aspect-ratio: 16 / 9;
        object-fit: cover;
        border-radius: 12px;
        background: #e9eadf;
    }

    .cover-placeholder {
        aspect-ratio: 16 / 9;
        max-height: 500px;
        display: grid;
        place-items: center;
        border-radius: 12px;
        background: var(--ink);
        color: var(--lime);
        font-size: clamp(22px, 4vw, 42px);
        font-weight: 900;
        letter-spacing: -1.5px;
    }

    .reading-layout {
        display: grid;
        grid-template-columns: minmax(0, var(--reading-width)) 220px;
        justify-content: center;
        align-items: start;
        gap: 52px;
        padding-bottom: 80px;
    }

    /* Article rich-text content */
    .article-content {
        min-width: 0;
        color: #35362f;
        font-size: 17px;
        line-height: 1.9;
        overflow-wrap: anywhere;
        word-break: normal;
    }

    .article-content > *:first-child {
        margin-top: 0;
    }

    .article-content p {
        margin: 0 0 24px;
    }

    .article-content h1,
    .article-content h2,
    .article-content h3,
    .article-content h4,
    .article-content h5,
    .article-content h6 {
        color: var(--ink);
        font-weight: 800;
        letter-spacing: normal;
        overflow-wrap: anywhere;
    }

    .article-content h1 {
        font-size: clamp(32px, 4vw, 44px);
        line-height: 1.2;
        margin: 38px 0 18px;
    }

    .article-content h2 {
        font-size: 30px;
        line-height: 1.3;
        margin: 42px 0 18px;
    }

    .article-content h3 {
        font-size: 23px;
        line-height: 1.4;
        margin: 32px 0 14px;
    }

    .article-content h4,
    .article-content h5,
    .article-content h6 {
        font-size: 19px;
        line-height: 1.5;
        margin: 26px 0 12px;
    }

    .article-content strong,
    .article-content b {
        font-weight: 800;
    }

    .article-content em,
    .article-content i {
        font-style: italic;
    }

    .article-content s,
    .article-content del {
        text-decoration: line-through;
    }

    .article-content ul,
    .article-content ol {
        padding-inline-start: 28px;
        margin: 0 0 26px;
    }

    .article-content li {
        margin-bottom: 9px;
        padding-inline-start: 3px;
    }

    .article-content li p {
        margin-bottom: 8px;
    }

    .article-content blockquote {
        margin: 32px 0;
        padding: 8px 24px;
        border-inline-start: 4px solid var(--lime);
        color: #55574f;
        font-size: 20px;
    }

    .article-content pre {
        max-width: 100%;
        overflow-x: auto;
        background: #181914;
        color: #f4f4ec;
        border-radius: 8px;
        padding: 20px;
        font-size: 14px;
        line-height: 1.7;
    }

    .article-content code {
        overflow-wrap: anywhere;
        font-family: monospace;
    }

    .article-content hr {
        border: 0;
        border-top: 1px solid var(--line);
        margin: 38px 0;
    }

    .article-content a {
        color: #4d7217;
        text-decoration: underline;
        text-underline-offset: 3px;
    }

    .article-content img {
        display: block;
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 24px 0;
    }

    [dir="rtl"] .article-content {
        letter-spacing: normal;
    }

    .sidebar-card {
        position: sticky;
        top: 24px;
        padding: 22px;
        border: 1px solid var(--line);
        background: white;
        border-radius: 10px;
    }

    .sidebar-label {
        color: var(--muted);
        text-transform: uppercase;
        font-size: 10px;
        font-weight: 900;
        letter-spacing: 1.5px;
    }

    .sidebar-title {
        font-size: 17px;
        font-weight: 800;
        line-height: 1.5;
        margin: 12px 0 18px;
    }

    .sidebar-divider {
        border: 0;
        border-top: 1px solid var(--line);
        margin: 18px 0;
    }

    .author-name {
        font-size: 14px;
        font-weight: 800;
        margin-top: 9px;
    }

    .author-caption {
        color: var(--muted);
        font-size: 12px;
        margin-top: 4px;
    }

    .tag-list {
        display: flex;
        flex-wrap: wrap;
        gap: 7px;
        margin-top: 12px;
    }

    .tag {
        display: inline-block;
        padding: 6px 9px;
        background: #f0f1e9;
        border-radius: 4px;
        color: #51534b;
        font-size: 11px;
    }

    .bottom-cta {
        padding: 48px 0;
        background: var(--lime);
    }

    .cta-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 24px;
    }

    .cta-inner h2 {
        font-size: clamp(26px, 4vw, 36px);
        letter-spacing: -1px;
        margin: 0 0 9px;
    }

    .cta-inner p {
        color: #3d472c;
        margin: 0;
        line-height: 1.7;
    }

    .cta-button {
        display: inline-block;
        background: var(--ink);
        color: white;
        padding: 15px 20px;
        border-radius: 6px;
        font-size: 13px;
        font-weight: 800;
    }

    footer {
        background: var(--ink);
        color: white;
        padding: 30px 0;
    }

    .footer-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 18px;
    }

    .footer-copy {
        color: #a8aaa1;
        font-size: 12px;
    }

    .footer-links {
        display: flex;
        gap: 20px;
        font-size: 13px;
        color: #d0d1c9;
    }

    [dir="rtl"] h1,
    [dir="rtl"] .article-excerpt,
    [dir="rtl"] .article-content {
        letter-spacing: normal;
    }

    [dir="rtl"] .article-meta {
        direction: rtl;
    }

    @media (max-width: 900px) {
        .reading-layout {
            grid-template-columns: minmax(0, var(--reading-width));
            gap: 30px;
        }

        .sidebar-card {
            position: static;
            order: 2;
        }
    }

    @media (max-width: 600px) {
        .container {
            width: calc(100% - 30px);
        }

        .nav-inner {
            min-height: 68px;
        }

        .nav-links {
            gap: 12px;
        }

        .nav-links > a:not(.nav-cta) {
            display: none;
        }

        .article-header {
            padding: 42px 0 28px;
        }

        .back-link {
            margin-bottom: 28px;
        }

        h1 {
            font-size: clamp(35px, 10vw, 48px);
            letter-spacing: -1.7px;
        }

        .cover-section {
            padding-bottom: 30px;
        }

        .cover {
            aspect-ratio: 4 / 3;
            border-radius: 8px;
        }

        .reading-layout {
            padding-bottom: 52px;
        }

        .article-content {
            font-size: 16px;
            line-height: 1.9;
        }

        .article-content h1 {
            font-size: 30px;
        }

        .article-content h2 {
            font-size: 26px;
        }

        .article-content h3 {
            font-size: 21px;
        }

        .article-content blockquote {
            font-size: 18px;
            padding-inline-start: 16px;
        }

        .cta-inner {
            align-items: flex-start;
        }

        .footer-inner {
            align-items: flex-start;
        }
    }
</style>
</head>

<body>
    <header class="navbar">
        <div class="container nav-inner">
            <a href="/" class="logo">WebLab<span>Studios</span></a>

            <nav class="nav-links" aria-label="Main navigation">
                <a href="/">Home</a>
                <a href="{{ route('public.articles.index') }}">Insights</a>
                <a href="{{ route('public.articles.index') }}">All articles</a>
                <a href="/login" class="nav-cta">Client Portal ↗</a>
            </nav>
        </div>
    </header>

    <main>
        <article>
            <header class="article-header">
                <div class="container header-inner">
                    <a href="{{ route('public.articles.index') }}" class="back-link">
                        <span aria-hidden="true">←</span>
                        {{ $article->locale === 'ar' ? 'العودة إلى المقالات' : 'Back to all articles' }}
                    </a>

                    <div class="eyebrow">
                        {{ $article->category?->name ?: 'WebLab Journal' }}
                    </div>

                    <h1>{{ $article->title }}</h1>

                    @if ($article->excerpt)
                        <p class="article-excerpt">{{ $article->excerpt }}</p>
                    @endif

                    <div class="article-meta">
                        @if ($article->category)
                            <span class="category">{{ $article->category->name }}</span>
                            <span class="meta-dot"></span>
                        @endif

                        @if ($article->author)
                            <span>{{ $article->author->name }}</span>
                            <span class="meta-dot"></span>
                        @endif

                        @if ($article->published_at)
                            <time datetime="{{ $article->published_at->toIso8601String() }}">
                                {{ $article->published_at->format('M d, Y') }}
                            </time>
                        @endif

                        @if ($article->locale)
                            <span class="meta-dot"></span>
                            <span>{{ strtoupper($article->locale) }}</span>
                        @endif
                    </div>
                </div>
            </header>

            <section class="cover-section">
                <div class="container">
                    @if ($article->image)
                        <img class="cover"
                            src="{{ \Illuminate\Support\Str::startsWith($article->image, ['http://', 'https://']) ? $article->image : \Illuminate\Support\Facades\Storage::disk('public')->url($article->image) }}"
                            alt="{{ $article->title }}" fetchpriority="high">
                    @else
                        <div class="cover-placeholder">WebLabStudios</div>
                    @endif
                </div>
            </section>

            <div class="container reading-layout">
                <div class="article-content">
                    @if ($article->content)
                        {{--
                            Content is escaped intentionally for safety.
                            Use a trusted HTML sanitizer before rendering
                            rich HTML from an editor.
                        --}}
                        {!! app('purifier')->clean($article->content) !!}
                    @else
                        <p>
                            {{ $article->locale === 'ar'
                                ? 'لا يوجد محتوى إضافي لهذا المقال حتى الآن.'
                                : 'There is no additional content for this article yet.' }}
                        </p>
                    @endif
                </div>

                <aside class="sidebar-card">
                    <div class="sidebar-label">About this article</div>
                    <div class="sidebar-title">{{ $article->title }}</div>

                    @if ($article->author)
                        <hr class="sidebar-divider">

                        <div class="sidebar-label">Written by</div>
                        <div class="author-name">{{ $article->author->name }}</div>
                        <div class="author-caption">WebLabStudios contributor</div>
                    @endif

                    @if ($article->category)
                        <hr class="sidebar-divider">

                        <div class="sidebar-label">Category</div>
                        <div class="author-name">{{ $article->category->name }}</div>
                    @endif

                    @if ($article->tags->isNotEmpty())
                        <hr class="sidebar-divider">

                        <div class="sidebar-label">Topics</div>
                        <div class="tag-list">
                            @foreach ($article->tags as $tag)
                                <span class="tag">{{ $tag->name }}</span>
                            @endforeach
                        </div>
                    @endif

                    <hr class="sidebar-divider">

                    <a href="{{ route('public.articles.index') }}" class="back-link" style="margin:0">
                        ← Explore more articles
                    </a>
                </aside>
            </div>
        </article>

        <section class="bottom-cta">
            <div class="container cta-inner">
                <div>
                    <h2>Enjoyed this article?</h2>
                    <p>Explore more ideas and insights from WebLabStudios.</p>
                </div>

                <a href="{{ route('public.articles.index') }}" class="cta-button">
                    Explore all articles ↗
                </a>
            </div>
        </section>
    </main>

    <footer>
        <div class="container footer-inner">
            <a href="/" class="logo">WebLab<span>Studios</span></a>

            <div class="footer-copy">
                © {{ date('Y') }} WebLabStudios. All rights reserved.
            </div>

            <div class="footer-links">
                <a href="/">Home</a>
                <a href="{{ route('public.articles.index') }}">Journal</a>
                <a href="/login">Client Portal</a>
            </div>
        </div>
    </footer>
</body>

</html>
