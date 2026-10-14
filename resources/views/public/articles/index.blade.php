<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insights & Articles | WebLabStudios</title>
    <meta name="description" content="Ideas, insights, and practical guides on web development, digital experiences, and technology.">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --lime: #c6ff5e;
            --ink: #11120f;
            --paper: #f7f7f2;
            --muted: #777970;
            --line: #e4e5dc;
        }

        * { box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            color: var(--ink);
            background: var(--paper);
            font-family: Inter, Arial, Helvetica, sans-serif;
        }
        a { color: inherit; text-decoration: none; }
        button, input { font: inherit; }

        .container {
            width: min(1160px, calc(100% - 44px));
            margin: auto;
        }

        .navbar {
            background: var(--ink);
            color: white;
            border-bottom: 1px solid #30312b;
        }
        .nav-inner {
            min-height: 78px;
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
        .logo span { color: var(--lime); }
        .nav-links {
            display: flex;
            align-items: center;
            gap: 28px;
            color: #d2d3cc;
            font-size: 14px;
        }
        .nav-links a:hover { color: var(--lime); }
        .nav-cta {
            background: var(--lime);
            color: var(--ink);
            padding: 12px 17px;
            border-radius: 6px;
            font-weight: 800;
        }

        .hero {
            background: var(--ink);
            color: white;
            padding: 78px 0 88px;
            position: relative;
            overflow: hidden;
        }
        .hero:after {
            content: "";
            position: absolute;
            width: 380px;
            height: 380px;
            border: 1px solid #33372c;
            border-radius: 50%;
            right: -80px;
            top: -120px;
            box-shadow: 0 0 0 45px #ffffff04, 0 0 0 90px #ffffff03;
            pointer-events: none;
        }
        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: var(--lime);
            font-size: 12px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .eyebrow:before {
            content: "";
            width: 24px;
            height: 2px;
            background: var(--lime);
        }
        .hero h1 {
            max-width: 780px;
            margin: 24px 0 18px;
            font-size: clamp(42px, 7vw, 76px);
            line-height: 1.02;
            letter-spacing: -4px;
        }
        .hero h1 span { color: var(--lime); }
        .hero p {
            max-width: 570px;
            color: #b9bbb2;
            line-height: 1.8;
            font-size: 17px;
            margin: 0;
        }
        .hero-bottom {
            margin-top: 36px;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
        }
        .hero-button {
            background: var(--lime);
            color: var(--ink);
            padding: 14px 20px;
            border-radius: 6px;
            font-weight: 800;
            display: inline-block;
        }
        .hero-note { color: #a7a99f; font-size: 13px; }

        .content-section { padding: 64px 0 84px; }
        .section-head {
            display: flex;
            justify-content: space-between;
            align-items: end;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 28px;
        }
        .section-head h2 {
            font-size: clamp(27px, 4vw, 38px);
            margin: 10px 0 0;
            letter-spacing: -1.5px;
        }
        .result-count { color: var(--muted); font-size: 14px; }

        .toolbar {
            display: flex;
            gap: 12px;
            margin-bottom: 32px;
        }
        .search {
            flex: 1;
            min-width: 0;
            border: 1px solid var(--line);
            border-radius: 7px;
            padding: 14px 16px;
            background: white;
            outline: none;
        }
        .search:focus { border-color: #9abf48; }
        .search-button {
            border: 0;
            background: var(--ink);
            color: white;
            border-radius: 7px;
            padding: 0 22px;
            cursor: pointer;
            font-weight: 700;
        }

        .article-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 24px;
        }
        .article-card {
            background: white;
            border: 1px solid var(--line);
            border-radius: 12px;
            overflow: hidden;
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .article-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 15px 35px #1111110d;
        }
        .article-image {
            display: block;
            width: 100%;
            height: 220px;
            object-fit: cover;
            background: #e9eadf;
        }
        .image-placeholder {
            height: 220px;
            display: grid;
            place-items: center;
            background: #e9eadf;
            color: #777970;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 2px;
        }
        .article-body { padding: 23px; }
        .article-meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 9px;
            color: var(--muted);
            font-size: 12px;
        }
        .category {
            display: inline-block;
            background: #eff8df;
            color: #435c1d;
            padding: 6px 9px;
            border-radius: 4px;
            font-weight: 800;
        }
        .article-card h3 {
            font-size: 22px;
            line-height: 1.3;
            letter-spacing: -.6px;
            margin: 17px 0 12px;
        }
        .article-card h3 a:hover { color: #587e1c; }
        .excerpt {
            font-size: 14px;
            line-height: 1.8;
            color: #65675f;
            margin: 0 0 22px;
        }
        .read-more {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            font-size: 13px;
            font-weight: 900;
        }
        .read-more span { color: #638b20; font-size: 18px; }

        .empty {
            padding: 60px 24px;
            text-align: center;
            background: white;
            border: 1px solid var(--line);
            border-radius: 12px;
        }
        .empty h3 { font-size: 24px; margin: 0 0 10px; }
        .empty p { color: var(--muted); line-height: 1.7; }

        .pagination {
            margin-top: 42px;
        }
        .pagination nav > div:first-child {
            color: var(--muted);
            font-size: 13px;
        }
        .pagination nav > div:last-child {
            display: flex;
            justify-content: center;
            gap: 7px;
            flex-wrap: wrap;
            margin-top: 12px;
        }
        .pagination a, .pagination span {
            display: inline-block;
            padding: 10px 14px;
            background: white;
            border: 1px solid var(--line);
            border-radius: 5px;
            font-size: 13px;
        }
        .pagination [aria-current="page"] span {
            background: var(--lime);
            color: var(--ink);
        }

        .newsletter {
            background: var(--lime);
            padding: 48px 0;
        }
        .newsletter-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 24px;
            flex-wrap: wrap;
        }
        .newsletter h2 {
            font-size: clamp(25px, 4vw, 36px);
            letter-spacing: -1px;
            margin: 0 0 8px;
        }
        .newsletter p { margin: 0; color: #394425; line-height: 1.7; }
        .newsletter-link {
            display: inline-block;
            background: var(--ink);
            color: white;
            border-radius: 6px;
            padding: 14px 19px;
            font-weight: 800;
        }

        footer {
            background: var(--ink);
            color: white;
            padding: 32px 0;
        }
        .footer-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
            flex-wrap: wrap;
        }
        .footer-copy { color: #a9aba2; font-size: 13px; }
        .footer-links { display: flex; gap: 20px; color: #d0d1c9; font-size: 13px; }

        @media (max-width: 900px) {
            .article-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .hero:after { right: -230px; }
        }
        @media (max-width: 600px) {
            .container { width: min(100% - 30px, 1160px); }
            .nav-inner { min-height: 68px; }
            .nav-links { gap: 12px; }
            .nav-links > a:not(.nav-cta) { display: none; }
            .hero { padding: 58px 0 64px; }
            .hero h1 { letter-spacing: -2px; }
            .hero p { font-size: 15px; }
            .content-section { padding: 44px 0 60px; }
            .article-grid { grid-template-columns: 1fr; }
            .article-image, .image-placeholder { height: 230px; }
            .toolbar { flex-direction: column; }
            .search-button { padding: 14px; }
            .newsletter-inner { align-items: flex-start; }
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
                <a href="#latest">Latest articles</a>
                <a href="/login" class="nav-cta">Client Portal ↗</a>
            </nav>
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="container">
                <span class="eyebrow">The WebLab Journal</span>
                <h1>Ideas that move<br>the web <span>forward.</span></h1>
                <p>
                    Practical insights, fresh perspectives, and useful guides
                    for building better digital experiences.
                </p>
                <div class="hero-bottom">
                    <a href="#latest" class="hero-button">Explore the articles ↘</a>
                    <span class="hero-note">Ideas, knowledge &amp; digital craft.</span>
                </div>
            </div>
        </section>

        <section class="content-section" id="latest">
            <div class="container">
                <div class="section-head">
                    <div>
                        <span class="eyebrow" style="color:#5b7e20">Explore &amp; Learn</span>
                        <h2>Latest articles</h2>
                    </div>
                    <div class="result-count">
                        {{ $articles->total() }} {{ Str::plural('article', $articles->total()) }}
                    </div>
                </div>

                <form class="toolbar" action="{{ route('public.articles.index') }}" method="GET">
                    <input
                        class="search"
                        type="search"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search articles..."
                        aria-label="Search articles"
                    >
                    <button class="search-button" type="submit">Search articles</button>
                </form>

                @if($articles->count())
                    <div class="article-grid">
                        @foreach($articles as $article)
                            <article class="article-card">
                                <a href="{{ route('public.articles.show', $article->slug) }}"
                                   aria-label="Read {{ $article->title }}">
                                    @if($article->image)
                                        <img
                                            class="article-image"
                                            src="{{ \Illuminate\Support\Str::startsWith($article->image, ['http://', 'https://']) ? $article->image : \Illuminate\Support\Facades\Storage::disk('public')->url($article->image) }}"
                                            alt="{{ $article->title }}"
                                            loading="lazy"
                                        >
                                    @else
                                        <div class="image-placeholder">WEBLAB STUDIOS</div>
                                    @endif
                                </a>

                                <div class="article-body">
                                    <div class="article-meta">
                                        @if($article->category)
                                            <span class="category">{{ $article->category->name }}</span>
                                        @endif
                                        <span>{{ $article->published_at?->format('M d, Y') }}</span>
                                    </div>

                                    <h3>
                                        <a href="{{ route('public.articles.show', $article->slug) }}">
                                            {{ $article->title }}
                                        </a>
                                    </h3>

                                    <p class="excerpt">
                                        {{ $article->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($article->content), 150) }}
                                    </p>

                                    <a class="read-more"
                                       href="{{ route('public.articles.show', $article->slug) }}">
                                        Read article <span>↗</span>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div class="pagination">
                        {{ $articles->withQueryString()->links() }}
                    </div>
                @else
                    <div class="empty">
                        <h3>No articles found yet</h3>
                        <p>
                            @if(request('search'))
                                Try another search term.
                            @else
                                New insights are on their way. Please check back soon.
                            @endif
                        </p>
                        @if(request('search'))
                            <a class="hero-button" href="{{ route('public.articles.index') }}">
                                View all articles
                            </a>
                        @endif
                    </div>
                @endif
            </div>
        </section>

        <section class="newsletter">
            <div class="container newsletter-inner">
                <div>
                    <h2>Build something meaningful.</h2>
                    <p>Explore our work and discover how better digital experiences come together.</p>
                </div>
                <a href="/" class="newsletter-link">Discover WebLabStudios ↗</a>
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
