<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Articles | WebLab Studios CMS</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --ink: #11120f;
            --lime: #c8ff35;
            --paper: #f5f5ef;
            --line: #e2e2d9;
            --muted: #85867c;
            --white: #fffefa;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            background: var(--paper);
            color: var(--ink);
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
        }

        a { color: inherit; text-decoration: none; }
        button, input, select { font: inherit; }

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 20;
            display: flex;
            flex-direction: column;
            width: 228px;
            padding: 25px 14px 18px;
            color: #f7f7f0;
            background: var(--ink);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 9px 32px;
        }

        .brand-mark {
            display: grid;
            width: 32px;
            height: 32px;
            flex-shrink: 0;
            place-items: center;
            background: var(--lime);
            color: var(--ink);
            font-size: 11px;
            font-weight: 900;
        }

        .brand-name { font-size: 14px; font-weight: 700; }

        .brand-sub {
            margin-top: 5px;
            color: #96978c;
            font-size: 8px;
            letter-spacing: 1.5px;
        }

        .nav-label {
            padding: 0 10px;
            margin-bottom: 10px;
            color: #898a7f;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1.4px;
        }

        .nav-links { display: grid; gap: 5px; }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 13px;
            min-height: 39px;
            padding: 0 10px;
            border: 1px solid transparent;
            color: #e8e8df;
            font-size: 12px;
        }

        .nav-icon {
            width: 18px;
            color: #bfc0b5;
            font-size: 10px;
            font-weight: 700;
        }

        .nav-link.active {
            border-color: var(--lime);
            outline: 3px solid #34392a;
            background: var(--lime);
            color: var(--ink);
            font-weight: 700;
        }

        .nav-link.active .nav-icon { color: var(--ink); }
        .nav-link:hover:not(.active) { background: #24251f; }

        .sidebar-bottom {
            display: grid;
            gap: 8px;
            margin-top: auto;
            padding-top: 18px;
            border-top: 1px solid #303129;
        }

        .sidebar-bottom a {
            padding: 10px;
            color: #e8e8df;
            font-size: 11px;
        }

        .logout-button {
            width: 100%;
            padding: 10px;
            border: 0;
            background: transparent;
            color: #e8e8df;
            text-align: left;
            font-size: 11px;
            cursor: pointer;
        }

        .main {
            min-height: 100vh;
            margin-left: 228px;
            padding: 0 38px 45px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 58px;
            border-bottom: 1px solid var(--line);
        }

        .workspace {
            color: var(--muted);
            font-size: 9px;
            letter-spacing: 1.5px;
        }

        .workspace span {
            margin-right: 8px;
            color: #7c8a62;
        }

        .user-menu { color: #64655c; font-size: 10px; }

        .content {
            width: 100%;
            max-width: 1160px;
            margin: 60px auto 0;
        }

        .eyebrow {
            margin-bottom: 10px;
            color: #74756b;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1.8px;
            text-transform: uppercase;
        }

        .heading-row {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 30px;
        }

        h1 {
            margin: 0;
            font-size: clamp(40px, 4.1vw, 58px);
            font-weight: 500;
            letter-spacing: -3.5px;
            line-height: 1.05;
        }

        .subtitle {
            margin: 12px 0 0;
            color: #77786e;
            font-size: 13px;
            line-height: 1.6;
        }

        .primary-button {
            display: inline-flex;
            min-height: 43px;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 0 18px;
            border: 1px solid var(--ink);
            background: var(--lime);
            color: var(--ink);
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
        }

        .primary-button:hover { background: #b9f124; }

        .toolbar {
            display: grid;
            grid-template-columns: minmax(150px, 1fr) auto 130px 140px 40px;
            gap: 8px;
            margin-bottom: 12px;
        }

        .search-wrap { position: relative; }

        .search-symbol {
            position: absolute;
            top: 50%;
            left: 13px;
            color: #85867b;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .control {
            width: 100%;
            min-height: 39px;
            padding: 0 11px;
            border: 1px solid #dfdfd5;
            border-radius: 0;
            outline: none;
            background: var(--white);
            color: #292a25;
            font-size: 12px;
        }

        .search-input { padding-left: 33px; }
        .control:focus { border-color: #88897d; }

        .search-button, .refresh-button {
            min-height: 39px;
            padding: 0 13px;
            border: 1px solid #dfdfd5;
            background: var(--white);
            cursor: pointer;
        }

        .search-button:hover, .refresh-button:hover { background: #ebebe2; }

        .alert {
            margin-bottom: 20px;
            padding: 13px 16px;
            border: 1px solid #b6ddbc;
            background: #eaf6e9;
            color: #27643b;
            font-size: 12px;
        }

        .error-alert {
            border-color: #e6b7b1;
            background: #fff0ee;
            color: #9b2f24;
        }

        .table-wrap {
            overflow: hidden;
            border: 1px solid #e1e1d7;
            background: var(--white);
        }

        .table-scroll { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        thead { background: #f0f0e9; }

        th {
            padding: 13px 16px;
            border-bottom: 1px solid var(--line);
            color: #74756b;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1.1px;
            white-space: nowrap;
        }

        td {
            padding: 15px 16px;
            border-bottom: 1px solid var(--line);
            font-size: 11px;
            vertical-align: middle;
        }

        tbody tr:last-child td { border-bottom: 0; }
        tbody tr:hover { background: #fafaf5; }

        .article-cell {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 220px;
        }

        .article-mark {
            display: grid;
            width: 35px;
            height: 35px;
            flex-shrink: 0;
            place-items: center;
            overflow: hidden;
            background: var(--lime);
            color: var(--ink);
            font-size: 9px;
            font-weight: 900;
        }

        .article-mark img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .article-title {
            overflow-wrap: anywhere;
            font-size: 11px;
            font-weight: 700;
        }

        .article-slug {
            margin-top: 5px;
            color: #929387;
            font-size: 10px;
            overflow-wrap: anywhere;
        }

        .status {
            display: inline-block;
            padding: 6px 9px;
            background: #e4f4e8;
            color: #277448;
            font-size: 9px;
            font-weight: 700;
        }

        .status.draft {
            background: #f8edcc;
            color: #8a6714;
        }

        .date-cell {
            color: #696a61;
            white-space: nowrap;
        }

        .actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 14px;
            white-space: nowrap;
        }

        .edit-link {
            font-size: 10px;
            font-weight: 700;
        }

        .edit-link:hover { text-decoration: underline; }

        .delete-button {
            padding: 0;
            border: 0;
            background: transparent;
            color: #c34b3d;
            font-size: 10px;
            cursor: pointer;
        }

        .delete-button:hover { text-decoration: underline; }

        .empty-state {
            padding: 55px 20px;
            text-align: center;
        }

        .empty-state h2 { margin: 0; font-size: 18px; }

        .empty-state p {
            margin: 10px 0 22px;
            color: var(--muted);
        }

        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-top: 18px;
            color: #74756b;
            font-size: 11px;
        }

        .pagination nav p { margin: 0; }
        .pagination nav > div { margin-top: 8px; }

        .mobile-menu, .sidebar-overlay { display: none; }

        @media (max-width: 1100px) {
            .main { padding-right: 24px; padding-left: 24px; }
            .toolbar {
                grid-template-columns: minmax(150px, 1fr) auto 120px 125px 40px;
                gap: 6px;
            }
            th, td { padding-right: 11px; padding-left: 11px; }
        }

        @media (max-width: 850px) {
            .sidebar {
                width: 245px;
                transform: translateX(-100%);
                transition: transform .2s ease;
            }

            .sidebar.open { transform: translateX(0); }

            .sidebar-overlay {
                position: fixed;
                inset: 0;
                z-index: 15;
                background: #0008;
            }

            .sidebar-overlay.open { display: block; }
            .main { margin-left: 0; padding: 0 20px 35px; }

            .mobile-menu {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 35px;
                height: 35px;
                margin-right: 10px;
                border: 1px solid var(--line);
                background: var(--white);
                cursor: pointer;
            }

            .topbar { justify-content: flex-start; gap: 10px; }
            .user-menu { margin-left: auto; }
            .content { margin-top: 40px; }

            .toolbar { grid-template-columns: minmax(0, 1fr) auto; }
            .heading-row { align-items: flex-end; }
        }

        @media (max-width: 520px) {
            .main { padding-right: 14px; padding-left: 14px; }
            .content { margin-top: 30px; }
            .heading-row {
                align-items: flex-start;
                flex-direction: column;
                gap: 18px;
            }
            h1 { font-size: 43px; letter-spacing: -2.5px; }
            .subtitle { font-size: 12px; }
            .primary-button { min-height: 40px; }
            .toolbar { grid-template-columns: minmax(0, 1fr) auto; }
            .table-scroll { overflow-x: auto; }
            table { min-width: 760px; }
            .pagination { align-items: flex-start; flex-direction: column; }
        }
    </style>
</head>

<body>
    <aside class="sidebar" id="sidebar">
        <a href="{{ route('dashboard') }}" class="brand">
            <div class="brand-mark">WL</div>
            <div>
                <div class="brand-name">WebLab</div>
                <div class="brand-sub">STUDIOS / CMS</div>
            </div>
        </a>

        <div class="nav-label">Workspace</div>

        <nav class="nav-links">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <span class="nav-icon">↗</span> Overview
            </a>
            <a class="nav-link active" href="{{ route('articles.index') }}">
                <span class="nav-icon">AR</span> Articles
            </a>
            <a class="nav-link" href="{{ route('projects.index') }}">
                <span class="nav-icon">PR</span> Projects
            </a>
            <a class="nav-link" href="#">
                <span class="nav-icon">SV</span> Services
            </a>
            <a class="nav-link" href="#">
                <span class="nav-icon">PG</span> Pages
            </a>
            <a class="nav-link" href="#">
                <span class="nav-icon">TX</span> Taxonomy
            </a>
            <a class="nav-link" href="#">
                <span class="nav-icon">MD</span> Media
            </a>
            <a class="nav-link" href="#">
                <span class="nav-icon">IN</span> Inquiries
            </a>
            <a class="nav-link" href="#">
                <span class="nav-icon">ST</span> Settings
            </a>
            <a class="nav-link" href="#">
                <span class="nav-icon">SE</span> SEO
            </a>
        </nav>

        <div class="sidebar-bottom">
            <a href="{{ url('/') }}" target="_blank" rel="noopener">
                ↗ &nbsp; View public site
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-button" type="submit">
                    ↪ &nbsp; Sign out
                </button>
            </form>
        </div>
    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <main class="main">
        <header class="topbar">
            <button
                class="mobile-menu"
                id="mobileMenu"
                type="button"
                aria-label="Open navigation"
                aria-expanded="false"
            >☰</button>

            <div class="workspace"><span>◇</span> PRIVATE WORKSPACE</div>

            <div class="user-menu">
                {{ auth()->user()->name }} &nbsp;⌄
            </div>
        </header>

        <section class="content">
            <div class="eyebrow">CONTENT / ARTICLES</div>

            <div class="heading-row">
                <div>
                    <h1>Articles</h1>
                    <p class="subtitle">
                        Manage articles, editorial content and publishing.
                    </p>
                </div>

                <a class="primary-button" href="{{ route('articles.create') }}">
                    <span style="font-size:18px;font-weight:400;">+</span>
                    New article
                </a>
            </div>

            @if (session('success'))
                <div class="alert">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="alert error-alert">
                    Please check your input and try again.
                </div>
            @endif

            <form class="toolbar" method="GET" action="{{ route('articles.index') }}">
                <div class="search-wrap">
                    <span class="search-symbol">⌕</span>
                    <input
                        class="control search-input"
                        type="search"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search articles..."
                        aria-label="Search articles"
                    >
                </div>

                <button class="search-button" type="submit">⌕ &nbsp; Search</button>

                <select class="control" name="locale" aria-label="Language">
                    <option value="">All languages</option>
                    <option value="en" @selected(request('locale') === 'en')>English</option>
                    <option value="ar" @selected(request('locale') === 'ar')>Arabic</option>
                    <option value="tr" @selected(request('locale') === 'tr')>Turkish</option>
                </select>

                <select class="control" name="status" aria-label="Status">
                    <option value="">All statuses</option>
                    <option value="published" @selected(request('status') === 'published')>Published</option>
                    <option value="draft" @selected(request('status') === 'draft')>Draft</option>
                </select>

                <button
                    class="refresh-button"
                    type="button"
                    onclick="window.location.href='{{ route('articles.index') }}'"
                    title="Reset filters"
                    aria-label="Reset filters"
                >↻</button>
            </form>

            <div class="table-wrap">
                @if ($articles->count())
                    <div class="table-scroll">
                        <table>
                            <thead>
                                <tr>
                                    <th style="width:34%">TITLE</th>
                                    <th>CATEGORY</th>
                                    <th>AUTHOR</th>
                                    <th>LANGUAGE</th>
                                    <th>STATUS</th>
                                    <th>UPDATED</th>
                                    <th style="text-align:right">ACTIONS</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($articles as $article)
                                    <tr>
                                        <td>
                                            <div class="article-cell">
                                                <div class="article-mark">
                                                    @if ($article->image)
                                                        @php
                                                            $imageUrl = \Illuminate\Support\Str::startsWith(
                                                                $article->image,
                                                                ['http://', 'https://']
                                                            )
                                                                ? $article->image
                                                                : \Illuminate\Support\Facades\Storage::disk('public')->url($article->image);
                                                        @endphp
                                                        <img
                                                            src="{{ $imageUrl }}"
                                                            alt=""
                                                            loading="lazy"
                                                        >
                                                    @else
                                                        AR
                                                    @endif
                                                </div>
                                                <div>
                                                    <div class="article-title">
                                                        {{ $article->title }}
                                                    </div>
                                                    <div class="article-slug">
                                                        {{ $article->slug }}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td>{{ $article->category?->name ?? '—' }}</td>
                                        <td>{{ $article->author?->name ?? '—' }}</td>
                                        <td>{{ strtoupper($article->locale) }}</td>

                                        <td>
                                            <span class="status {{ $article->status === 'draft' ? 'draft' : '' }}">
                                                {{ ucfirst($article->status) }}
                                            </span>
                                        </td>

                                        <td class="date-cell">
                                            {{ $article->updated_at?->format('M j, Y') ?? '—' }}
                                        </td>

                                        <td>
                                            <div class="actions">
                                                <a
                                                    class="edit-link"
                                                    href="{{ route('articles.edit', $article) }}"
                                                >Edit ↗</a>

                                                <form
                                                    method="POST"
                                                    action="{{ route('articles.destroy', $article) }}"
                                                    onsubmit="return confirm('Are you sure you want to delete this article?')"
                                                >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="delete-button" type="submit">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="empty-state">
                        <h2>No articles yet</h2>
                        <p>
                            Your articles will appear here when you create the first one.
                        </p>
                        <a class="primary-button" href="{{ route('articles.create') }}">
                            + New article
                        </a>
                    </div>
                @endif
            </div>

            @if ($articles->count())
                <div class="pagination">
                    <span>
                        Showing {{ $articles->firstItem() }}–{{ $articles->lastItem() }}
                        of {{ $articles->total() }} articles
                    </span>
                    <div>{{ $articles->links() }}</div>
                </div>
            @endif
        </section>
    </main>

    <script>
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const menuButton = document.getElementById('mobileMenu');

        function closeSidebar() {
            sidebar.classList.remove('open');
            overlay.classList.remove('open');
            menuButton.setAttribute('aria-expanded', 'false');
        }

        menuButton.addEventListener('click', () => {
            const isOpen = sidebar.classList.toggle('open');
            overlay.classList.toggle('open', isOpen);
            menuButton.setAttribute('aria-expanded', String(isOpen));
        });

        overlay.addEventListener('click', closeSidebar);

        document.querySelectorAll('.sidebar .nav-link').forEach(link => {
            link.addEventListener('click', closeSidebar);
        });
    </script>
</body>
</html>
