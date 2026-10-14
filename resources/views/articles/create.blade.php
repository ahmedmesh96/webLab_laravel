<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>New Article | WebLab Studios CMS</title>

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
        input, select, textarea, button { font: inherit; }

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 20;
            display: flex;
            flex-direction: column;
            width: 228px;
            padding: 25px 14px 18px;
            background: var(--ink);
            color: #f7f7f0;
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

        .sidebar-bottom a, .logout-button {
            padding: 10px;
            color: #e8e8df;
            font-size: 11px;
        }

        .logout-button {
            width: 100%;
            border: 0;
            background: transparent;
            text-align: left;
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

        .workspace span { margin-right: 8px; color: #7c8a62; }
        .user-menu { color: #64655c; font-size: 10px; }

        .content {
            width: 100%;
            max-width: 1160px;
            margin: 55px auto 0;
        }

        .eyebrow {
            margin-bottom: 10px;
            color: #74756b;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: 1.8px;
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
            font-size: clamp(38px, 4vw, 54px);
            font-weight: 500;
            letter-spacing: -3px;
            line-height: 1.05;
        }

        .subtitle {
            margin: 12px 0 0;
            color: #77786e;
            font-size: 13px;
            line-height: 1.6;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            min-height: 40px;
            padding: 0 14px;
            border: 1px solid var(--line);
            background: var(--white);
            font-size: 11px;
            font-weight: 700;
        }

        .form-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 300px;
            align-items: start;
            gap: 18px;
        }

        .panel {
            margin-bottom: 18px;
            border: 1px solid var(--line);
            background: var(--white);
        }

        .panel-header {
            padding: 17px 20px;
            border-bottom: 1px solid var(--line);
        }

        .panel-header h2 {
            margin: 0;
            font-size: 12px;
            font-weight: 700;
        }

        .panel-header p {
            margin: 6px 0 0;
            color: var(--muted);
            font-size: 11px;
            line-height: 1.5;
        }

        .panel-body { padding: 20px; }

        .field { margin-bottom: 19px; }
        .field:last-child { margin-bottom: 0; }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 11px;
            font-weight: 700;
        }

        .hint {
            margin-top: 7px;
            color: var(--muted);
            font-size: 10px;
            line-height: 1.5;
        }

        .control {
            width: 100%;
            min-height: 42px;
            padding: 10px 12px;
            border: 1px solid #dfdfd5;
            border-radius: 0;
            outline: none;
            background: var(--white);
            color: var(--ink);
            font-size: 12px;
        }

        textarea.control {
            min-height: 120px;
            resize: vertical;
            line-height: 1.6;
        }

        textarea.content-editor { min-height: 320px; }

        .control:focus { border-color: #85867c; }

        .two-columns {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .check-list {
            display: grid;
            gap: 11px;
        }

        .check-option {
            display: flex;
            align-items: center;
            gap: 9px;
            margin: 0;
            font-size: 11px;
            font-weight: 400;
        }

        .check-option input {
            accent-color: var(--ink);
        }

        .form-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 10px;
            padding: 17px 20px;
            border-top: 1px solid var(--line);
        }

        .primary-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 0 17px;
            border: 1px solid var(--ink);
            background: var(--lime);
            color: var(--ink);
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
        }

        .primary-button:hover { background: #b9f124; }

        .secondary-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
            padding: 0 15px;
            border: 1px solid var(--line);
            background: var(--white);
            font-size: 11px;
            font-weight: 700;
            cursor: pointer;
        }

        .alert {
            margin-bottom: 20px;
            padding: 13px 16px;
            border: 1px solid #e6b7b1;
            background: #fff0ee;
            color: #9b2f24;
            font-size: 12px;
        }

        .alert ul { margin: 8px 0 0; padding-left: 18px; }

        .mobile-menu, .sidebar-overlay { display: none; }

        @media (max-width: 1050px) {
            .main { padding-right: 24px; padding-left: 24px; }
            .form-layout { grid-template-columns: minmax(0, 1fr) 260px; }
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
            .form-layout { grid-template-columns: 1fr; }
        }

        @media (max-width: 520px) {
            .main { padding-right: 14px; padding-left: 14px; }
            .content { margin-top: 30px; }
            .heading-row { align-items: flex-start; flex-direction: column; }
            h1 { font-size: 42px; letter-spacing: -2.5px; }
            .two-columns { grid-template-columns: 1fr; }
            .panel-body { padding: 15px; }
            .form-actions { padding: 15px; }
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
            <a class="nav-link" href="#"><span class="nav-icon">SV</span> Services</a>
            <a class="nav-link" href="#"><span class="nav-icon">PG</span> Pages</a>
            <a class="nav-link" href="#"><span class="nav-icon">TX</span> Taxonomy</a>
            <a class="nav-link" href="#"><span class="nav-icon">MD</span> Media</a>
            <a class="nav-link" href="#"><span class="nav-icon">IN</span> Inquiries</a>
            <a class="nav-link" href="#"><span class="nav-icon">ST</span> Settings</a>
            <a class="nav-link" href="#"><span class="nav-icon">SE</span> SEO</a>
        </nav>

        <div class="sidebar-bottom">
            <a href="{{ url('/') }}" target="_blank" rel="noopener">
                ↗ &nbsp; View public site
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="logout-button" type="submit">↪ &nbsp; Sign out</button>
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
            <div class="user-menu">{{ auth()->user()->name }} &nbsp;⌄</div>
        </header>

        <section class="content">
            <div class="eyebrow">CONTENT / ARTICLES / NEW</div>

            <div class="heading-row">
                <div>
                    <h1>New article</h1>
                    <p class="subtitle">Create and prepare an article for publication.</p>
                </div>

                <a class="back-link" href="{{ route('articles.index') }}">
                    ← &nbsp; All articles
                </a>
            </div>

            @if ($errors->any())
                <div class="alert">
                    <strong>Please check the following fields:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                method="POST"
                action="{{ route('articles.store') }}"
                enctype="multipart/form-data"
            >
                @csrf

                <div class="form-layout">
                    <div>
                        <section class="panel">
                            <div class="panel-header">
                                <h2>Article content</h2>
                                <p>Write the article title, summary and main content.</p>
                            </div>

                            <div class="panel-body">
                                <div class="field">
                                    <label for="title">Article title *</label>
                                    <input
                                        class="control"
                                        id="title"
                                        name="title"
                                        value="{{ old('title') }}"
                                        required
                                        maxlength="255"
                                        placeholder="Enter article title"
                                    >
                                </div>

                                <div class="field">
                                    <label for="slug">URL slug</label>
                                    <input
                                        class="control"
                                        id="slug"
                                        name="slug"
                                        value="{{ old('slug') }}"
                                        maxlength="255"
                                        placeholder="generated-from-title"
                                    >
                                    <div class="hint">
                                        Leave blank to generate a slug from the title.
                                    </div>
                                </div>

                                <div class="field">
                                    <label for="excerpt">Excerpt</label>
                                    <textarea
                                        class="control"
                                        id="excerpt"
                                        name="excerpt"
                                        maxlength="500"
                                        placeholder="A short introduction to the article..."
                                    >{{ old('excerpt') }}</textarea>
                                </div>

                                <div class="field">
                                    <label for="content">Main content</label>
                                    <textarea
                                        class="control content-editor"
                                        id="content"
                                        name="content"
                                        placeholder="Write your article content here..."
                                    >{{ old('content') }}</textarea>
                                    <div class="hint">
                                        Plain text for now. We can add a rich-text editor in a later step.
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="panel">
                            <div class="panel-header">
                                <h2>Search engine optimization</h2>
                                <p>Optional metadata for search engines.</p>
                            </div>

                            <div class="panel-body">
                                <div class="field">
                                    <label for="meta_title">Meta title</label>
                                    <input
                                        class="control"
                                        id="meta_title"
                                        name="meta_title"
                                        value="{{ old('meta_title') }}"
                                        maxlength="255"
                                        placeholder="SEO title"
                                    >
                                </div>

                                <div class="field">
                                    <label for="meta_description">Meta description</label>
                                    <textarea
                                        class="control"
                                        id="meta_description"
                                        name="meta_description"
                                        maxlength="1000"
                                        placeholder="Short description for search results..."
                                    >{{ old('meta_description') }}</textarea>
                                </div>
                            </div>
                        </section>
                    </div>

                    <div>
                        <section class="panel">
                            <div class="panel-header">
                                <h2>Publishing</h2>
                                <p>Choose the language, status and publication date.</p>
                            </div>

                            <div class="panel-body">
                                <div class="field">
                                    <label for="status">Status *</label>
                                    <select class="control" id="status" name="status" required>
                                        <option value="draft" @selected(old('status', 'draft') === 'draft')>
                                            Draft
                                        </option>
                                        <option value="published" @selected(old('status') === 'published')>
                                            Published
                                        </option>
                                    </select>
                                </div>

                                <div class="field">
                                    <label for="locale">Language *</label>
                                    <select class="control" id="locale" name="locale" required>
                                        <option value="en" @selected(old('locale', 'en') === 'en')>English</option>
                                        <option value="ar" @selected(old('locale') === 'ar')>Arabic</option>
                                        <option value="tr" @selected(old('locale') === 'tr')>Turkish</option>
                                    </select>
                                </div>

                                <div class="field">
                                    <label for="published_at">Publication date</label>
                                    <input
                                        class="control"
                                        type="datetime-local"
                                        id="published_at"
                                        name="published_at"
                                        value="{{ old('published_at') }}"
                                    >
                                </div>
                            </div>
                        </section>

                        <section class="panel">
                            <div class="panel-header">
                                <h2>Article image</h2>
                                <p>Upload a cover image or provide an existing image URL.</p>
                            </div>

                            <div class="panel-body">
                                <div class="field">
                                    <label for="image_file">Upload cover image</label>
                                    <input
                                        class="control"
                                        style="padding:9px"
                                        type="file"
                                        id="image_file"
                                        name="image_file"
                                        accept="image/*"
                                    >
                                    <div class="hint">Maximum file size: 5 MB.</div>
                                </div>

                                <div class="field">
                                    <label for="image">Or image URL</label>
                                    <input
                                        class="control"
                                        type="url"
                                        id="image"
                                        name="image"
                                        value="{{ old('image') }}"
                                        placeholder="https://example.com/image.jpg"
                                    >
                                    <div class="hint">
                                        If you upload a file, it takes priority over the URL.
                                    </div>
                                </div>
                            </div>
                        </section>

                        <section class="panel">
                            <div class="panel-header">
                                <h2>Organization</h2>
                                <p>Assign a category, author and relevant tags.</p>
                            </div>

                            <div class="panel-body">
                                <div class="field">
                                    <label for="category_id">Category</label>
                                    <select class="control" id="category_id" name="category_id">
                                        <option value="">No category</option>
                                        @foreach ($categories as $category)
                                            <option
                                                value="{{ $category->id }}"
                                                @selected((string) old('category_id') === (string) $category->id)
                                            >
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="field">
                                    <label for="author_id">Author</label>
                                    <select class="control" id="author_id" name="author_id">
                                        <option value="">Current user</option>
                                        @foreach ($authors as $author)
                                            <option
                                                value="{{ $author->id }}"
                                                @selected((string) old('author_id') === (string) $author->id)
                                            >
                                                {{ $author->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="field">
                                    <label>Tags</label>
                                    <div class="check-list">
                                        @forelse ($tags as $tag)
                                            <label class="check-option">
                                                <input
                                                    type="checkbox"
                                                    name="tag_ids[]"
                                                    value="{{ $tag->id }}"
                                                    @checked(in_array($tag->id, old('tag_ids', [])))
                                                >
                                                {{ $tag->name }}
                                            </label>
                                        @empty
                                            <div class="hint">
                                                No tags exist yet. You can add tags later.
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>

                <div class="panel">
                    <div class="form-actions">
                        <a class="secondary-button" href="{{ route('articles.index') }}">
                            Cancel
                        </a>
                        <button class="primary-button" type="submit">
                            Save article &nbsp; ↗
                        </button>
                    </div>
                </div>
            </form>
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

        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');
        let slugEdited = slugInput.value.trim() !== '';

        slugInput.addEventListener('input', () => {
            slugEdited = slugInput.value.trim() !== '';
        });

        titleInput.addEventListener('input', () => {
            if (!slugEdited) {
                slugInput.value = titleInput.value
                    .toLowerCase()
                    .trim()
                    .replace(/[^a-z0-9]+/g, '-')
                    .replace(/^-+|-+$/g, '');
            }
        });
    </script>
</body>
</html>
