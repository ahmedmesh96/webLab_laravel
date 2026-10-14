<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Service | WebLab Studios CMS</title>
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
            font: 14px Arial, Helvetica, sans-serif;
        }

        a { color: inherit; text-decoration: none; }
        button, input, textarea, select { font: inherit; }

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 10;
            display: flex;
            flex-direction: column;
            width: 210px;
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
            place-items: center;
            background: var(--lime);
            color: var(--ink);
            font-weight: 900;
        }

        .brand-name { font-size: 14px; font-weight: 700; }
        .brand-sub { margin-top: 5px; color: #96978c; font-size: 8px; letter-spacing: 1.5px; }
        .nav-label { margin-bottom: 10px; padding: 0 10px; color: #898a7f; font-size: 9px; font-weight: 700; letter-spacing: 1.4px; }
        .nav-links { display: grid; gap: 5px; }
        .nav-link { display: flex; align-items: center; gap: 13px; min-height: 39px; padding: 0 10px; border: 1px solid transparent; color: #e8e8df; font-size: 12px; }
        .nav-icon { width: 18px; color: #bfc0b5; font-size: 10px; font-weight: 700; }
        .nav-link.active { border-color: var(--lime); background: var(--lime); color: var(--ink); font-weight: 700; }
        .nav-link:hover:not(.active) { background: #24251f; }

        .sidebar-bottom {
            display: grid;
            gap: 8px;
            margin-top: auto;
            padding-top: 18px;
            border-top: 1px solid #303129;
        }

        .sidebar-bottom a, .sidebar-bottom button {
            display: block;
            width: 100%;
            padding: 10px;
            border: 0;
            background: transparent;
            color: #e8e8df;
            text-align: left;
            font-size: 11px;
            cursor: pointer;
        }

        .main { min-height: 100vh; margin-left: 210px; padding: 0 38px 50px; }
        .topbar { display: flex; align-items: center; justify-content: space-between; min-height: 58px; border-bottom: 1px solid var(--line); }
        .workspace { color: var(--muted); font-size: 9px; letter-spacing: 1.5px; }
        .content { width: 100%; max-width: 1060px; margin: 42px auto 0; }
        .back { display: inline-block; margin-bottom: 30px; font-size: 12px; }
        .eyebrow { margin-bottom: 10px; color: #74756b; font-size: 9px; font-weight: 700; letter-spacing: 1.8px; }
        .heading-row { display: flex; align-items: flex-end; justify-content: space-between; gap: 20px; margin-bottom: 25px; }
        h1 { margin: 0; font-size: clamp(36px, 4vw, 50px); font-weight: 500; letter-spacing: -2px; }
        .subtitle { margin: 12px 0 0; color: #77786e; font-size: 13px; line-height: 1.6; }
        .button { display: inline-flex; align-items: center; justify-content: center; min-height: 40px; padding: 0 16px; border: 1px solid var(--ink); background: var(--white); color: var(--ink); font-size: 12px; cursor: pointer; }
        .button.primary { background: var(--lime); font-weight: 700; }

        .alert { margin-bottom: 18px; padding: 13px 16px; border: 1px solid #b6ddbc; background: #eaf6e9; color: #27643b; font-size: 12px; }
        .error-alert { margin-bottom: 18px; padding: 13px 16px; border: 1px solid #e6b7b1; background: #fff0ee; color: #9b2f24; font-size: 12px; }

        .panel { margin-bottom: 16px; border: 1px solid var(--line); background: var(--white); }
        .panel-head { padding: 18px 20px; border-bottom: 1px solid var(--line); }
        .panel-kicker { color: var(--muted); font-size: 9px; font-weight: 700; letter-spacing: 1.5px; }
        .panel-title { margin-top: 5px; font-size: 17px; font-weight: 700; }
        .panel-body { padding: 20px; }

        .language-tabs {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 16px;
            padding: 8px;
            border: 1px solid var(--line);
            background: var(--white);
        }

        .language-tab {
            padding: 12px 18px;
            border: 1px solid transparent;
            background: transparent;
            cursor: pointer;
            font-size: 12px;
        }

        .language-tab.active {
            border-color: var(--ink);
            background: var(--lime);
            font-weight: 700;
        }

        .language-panel { display: none; }
        .language-panel.active { display: block; }

        .language-note {
            margin-bottom: 18px;
            padding: 12px 14px;
            background: #f3f3eb;
            color: #626359;
            font-size: 11px;
            line-height: 1.6;
        }

        .field { margin-bottom: 20px; }
        .field:last-child { margin-bottom: 0; }
        .field label { display: block; margin-bottom: 8px; font-size: 11px; font-weight: 700; }

        .control {
            display: block;
            width: 100%;
            min-height: 40px;
            padding: 10px 11px;
            border: 1px solid #dfdfd5;
            outline: none;
            background: #fffefa;
            color: var(--ink);
            font-size: 12px;
        }

        .control:focus { border-color: #88897d; }
        textarea.control { min-height: 140px; resize: vertical; line-height: 1.7; }
        .hint { margin-top: 7px; color: var(--muted); font-size: 10px; line-height: 1.5; }
        .error { margin-top: 6px; color: #a72d25; font-size: 11px; }

        .form-grid { display: grid; grid-template-columns: minmax(0, 1fr) 270px; gap: 18px; align-items: start; }
        .status-option { display: flex; align-items: center; gap: 9px; padding: 12px; border: 1px solid var(--line); margin-bottom: 7px; font-size: 12px; }
        .status-option input { accent-color: #789c22; }
        .form-actions { display: flex; justify-content: flex-end; gap: 9px; margin-top: 20px; }

        [dir="rtl"] { text-align: right; }
        [dir="rtl"] .field label { text-align: right; }
        [dir="rtl"] .status-option { flex-direction: row-reverse; justify-content: flex-end; }

        @media(max-width: 950px) {
            .form-grid { grid-template-columns: minmax(0, 1fr); }
            .main { padding-right: 22px; padding-left: 22px; }
        }

        @media(max-width: 700px) {
            .sidebar { display: none; }
            .main { margin-left: 0; padding: 0 15px 35px; }
            .content { margin-top: 30px; }
            .heading-row { align-items: flex-start; flex-direction: column; }
        }
    </style>
</head>
<body>
    <aside class="sidebar">
        <a href="{{ route('dashboard') }}" class="brand">
            <div class="brand-mark">WL</div>
            <div>
                <div class="brand-name">WebLab</div>
                <div class="brand-sub">STUDIOS / CMS</div>
            </div>
        </a>

        <div class="nav-label">Workspace</div>
        <nav class="nav-links">
            <a class="nav-link" href="{{ route('dashboard') }}"><span class="nav-icon">↗</span> Overview</a>
            <a class="nav-link" href="{{ route('articles.index') }}"><span class="nav-icon">AR</span> Articles</a>
            <a class="nav-link" href="{{ route('projects.index') }}"><span class="nav-icon">PR</span> Projects</a>
            <a class="nav-link active" href="{{ route('services.index') }}"><span class="nav-icon">SV</span> Services</a>
            <a class="nav-link" href="#pages"><span class="nav-icon">PG</span> Pages</a>
            <a class="nav-link" href="#taxonomy"><span class="nav-icon">TX</span> Taxonomy</a>
            <a class="nav-link" href="#media"><span class="nav-icon">MD</span> Media</a>
            <a class="nav-link" href="#inquiries"><span class="nav-icon">IN</span> Inquiries</a>
            <a class="nav-link" href="#settings"><span class="nav-icon">ST</span> Settings</a>
            <a class="nav-link" href="#seo"><span class="nav-icon">SE</span> SEO</a>
        </nav>

        <div class="sidebar-bottom">
            <a href="{{ url('/') }}" target="_blank" rel="noopener">↗ &nbsp; View public site</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">↪ &nbsp; Sign out</button>
            </form>
        </div>
    </aside>

    <main class="main">
        <header class="topbar">
            <div class="workspace">◇ &nbsp; PRIVATE WORKSPACE</div>
            <div style="margin-left:auto;color:#64655c;font-size:10px">
                {{ auth()->user()->name }} &nbsp;⌄
            </div>
        </header>

        <section class="content">
            <a class="back" href="{{ route('services.index') }}">← Back to Services</a>

            <div class="heading-row">
                <div>
                    <div class="eyebrow">SERVICE / MULTILINGUAL EDITOR</div>
                    <h1>Edit service</h1>
                    <p class="subtitle">Manage English, Arabic and Turkish content independently.</p>
                </div>
                <span>{{ ucfirst($service->status) }}</span>
            </div>

            @if (session('success'))
                <div class="alert">{{ session('success') }}</div>
            @endif

            @if ($errors->any())
                <div class="error-alert">
                    Please check the fields marked below and try again.
                    <ul style="margin-bottom:0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @php
                $localeNames = [
                    'en' => 'English',
                    'ar' => 'العربية',
                    'tr' => 'Türkçe',
                ];
                $localeDirections = ['en' => 'ltr', 'ar' => 'rtl', 'tr' => 'ltr'];
            @endphp

            <form method="POST" action="{{ route('services.update', $service) }}">
                @csrf
                @method('PUT')

                <div class="language-tabs" role="tablist" aria-label="Service languages">
                    @foreach ($localeNames as $locale => $label)
                        <button
                            class="language-tab {{ $loop->first ? 'active' : '' }}"
                            type="button"
                            role="tab"
                            aria-selected="{{ $loop->first ? 'true' : 'false' }}"
                            data-locale-tab="{{ $locale }}"
                        >
                            {{ $label }}
                            @if ($locale === 'en') · Required @endif
                        </button>
                    @endforeach
                </div>

                @foreach ($localeNames as $locale => $label)
                    @php
                        $translation = $translations->get($locale);
                        $defaultStatus = $translation?->status ?? ($locale === 'en' ? $service->status : 'draft');
                        $field = fn ($key, $default = '') => old(
                            "translations.{$locale}.{$key}",
                            data_get($translation, $key, $default)
                        );
                    @endphp

                    <section
                        class="language-panel {{ $loop->first ? 'active' : '' }}"
                        data-locale-panel="{{ $locale }}"
                        lang="{{ $locale }}"
                        dir="{{ $localeDirections[$locale] }}"
                    >
                        <div class="form-grid">
                            <div class="panel">
                                <div class="panel-head">
                                    <div class="panel-kicker">{{ strtoupper($locale) }} / CONTENT</div>
                                    <div class="panel-title">{{ $label }} service content</div>
                                </div>

                                <div class="panel-body">
                                    @if ($locale !== 'en' && !$translation)
                                        <div class="language-note">
                                            This translation has not been created yet. Add a name to create it.
                                            Leave the name empty if you want to configure this language later.
                                        </div>
                                    @endif

                                    <div class="field">
                                        <label for="{{ $locale }}-name">
                                            Service name {{ $locale === 'en' ? '*' : '' }}
                                        </label>
                                        <input
                                            class="control"
                                            id="{{ $locale }}-name"
                                            name="translations[{{ $locale }}][name]"
                                            value="{{ $field('name') }}"
                                            maxlength="255"
                                            {{ $locale === 'en' ? 'required' : '' }}
                                        >
                                        @error("translations.{$locale}.name")
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="field">
                                        <label for="{{ $locale }}-slug">URL slug</label>
                                        <input
                                            class="control"
                                            id="{{ $locale }}-slug"
                                            name="translations[{{ $locale }}][slug]"
                                            value="{{ $field('slug') }}"
                                            maxlength="255"
                                        >
                                        <div class="hint">Leave blank to generate a URL slug from the service name.</div>
                                        @error("translations.{$locale}.slug")
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="field">
                                        <label for="{{ $locale }}-description">Description</label>
                                        <textarea
                                            class="control"
                                            id="{{ $locale }}-description"
                                            name="translations[{{ $locale }}][description]"
                                            rows="8"
                                        >{{ $field('description') }}</textarea>
                                        @error("translations.{$locale}.description")
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <aside>
                                <div class="panel">
                                    <div class="panel-head">
                                        <div class="panel-kicker">LIFECYCLE</div>
                                        <div class="panel-title">Publishing</div>
                                    </div>

                                    <div class="panel-body">
                                        @foreach (['draft' => 'Draft', 'published' => 'Published', 'archived' => 'Archived'] as $value => $statusLabel)
                                            <label class="status-option">
                                                <input
                                                    type="radio"
                                                    name="translations[{{ $locale }}][status]"
                                                    value="{{ $value }}"
                                                    @checked(old("translations.{$locale}.status", $defaultStatus) === $value)
                                                >
                                                {{ $statusLabel }}
                                            </label>
                                        @endforeach

                                        @error("translations.{$locale}.status")
                                            <div class="error">{{ $message }}</div>
                                        @enderror

                                        <div class="hint">
                                            Publishing status applies to this language only.
                                        </div>
                                    </div>
                                </div>

                                <div class="panel">
                                    <div class="panel-head">
                                        <div class="panel-kicker">SEARCH ENGINE</div>
                                        <div class="panel-title">SEO metadata</div>
                                    </div>

                                    <div class="panel-body">
                                        <div class="field">
                                            <label for="{{ $locale }}-meta-title">Meta title</label>
                                            <input
                                                class="control"
                                                id="{{ $locale }}-meta-title"
                                                name="translations[{{ $locale }}][meta_title]"
                                                value="{{ $field('meta_title') }}"
                                                maxlength="255"
                                            >
                                            @error("translations.{$locale}.meta_title")
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="field">
                                            <label for="{{ $locale }}-meta-description">Meta description</label>
                                            <textarea
                                                class="control"
                                                id="{{ $locale }}-meta-description"
                                                name="translations[{{ $locale }}][meta_description]"
                                                rows="4"
                                            >{{ $field('meta_description') }}</textarea>
                                            @error("translations.{$locale}.meta_description")
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </aside>
                        </div>
                    </section>
                @endforeach

                <div class="form-actions">
                    <a class="button" href="{{ route('services.index') }}">Cancel</a>
                    <button class="button primary" type="submit">Save all translations</button>
                </div>
            </form>
        </section>
    </main>

    <script>
        document.querySelectorAll('[data-locale-tab]').forEach((tab) => {
            tab.addEventListener('click', () => {
                const locale = tab.dataset.localeTab;

                document.querySelectorAll('[data-locale-tab]').forEach((item) => {
                    const active = item === tab;
                    item.classList.toggle('active', active);
                    item.setAttribute('aria-selected', active ? 'true' : 'false');
                });

                document.querySelectorAll('[data-locale-panel]').forEach((panel) => {
                    panel.classList.toggle('active', panel.dataset.localePanel === locale);
                });
            });
        });

        // Open the language containing the first validation error.
        @if ($errors->any())
            const errorField = @json(array_key_first($errors->toArray()));
            const match = errorField.match(/^translations\.([a-z]{2})\./);

            if (match) {
                document.querySelector(`[data-locale-tab="${match[1]}"]`)?.click();
            }
        @endif
    </script>
</body>
</html>
