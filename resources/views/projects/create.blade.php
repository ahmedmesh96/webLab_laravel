<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Project | WebLabStudios</title>

    <style>
        :root {
            --black: #171815;
            --black-soft: #22231f;
            --lime: #d7ff64;
            --paper: #f6f6f0;
            --white: #ffffff;
            --text: #20211e;
            --muted: #85877e;
            --border: #e4e5dc;
            --danger: #b42318;
            --radius: 14px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI",
                sans-serif;
            color: var(--text);
            background: var(--paper);
        }

        button,
        input,
        select,
        textarea {
            font: inherit;
        }

        button,
        a {
            -webkit-tap-highlight-color: transparent;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .app {
            min-height: 100vh;
        }

        /* SIDEBAR */

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 100;
            width: 250px;
            padding: 28px 20px;
            display: flex;
            flex-direction: column;
            color: white;
            background: var(--black);
            transition: transform 0.25s ease;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 45px;
            padding: 0 8px;
        }

        .brand-mark {
            display: grid;
            place-items: center;
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            color: var(--black);
            background: var(--lime);
            border-radius: 12px;
            font-size: 22px;
            font-weight: 900;
        }

        .brand-name {
            font-size: 17px;
            font-weight: 800;
            letter-spacing: -0.7px;
        }

        .brand-caption {
            margin-top: 4px;
            color: #999b91;
            font-size: 10px;
            letter-spacing: 1.7px;
            text-transform: uppercase;
        }

        .nav-label {
            margin: 0 10px 12px;
            color: #77796f;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.8px;
            text-transform: uppercase;
        }

        .nav {
            display: grid;
            gap: 7px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            min-height: 45px;
            padding: 12px 13px;
            color: #c1c3b9;
            border-radius: 10px;
            font-size: 13px;
            transition: 0.2s ease;
        }

        .nav-link:hover {
            color: white;
            background: #292a25;
        }

        .nav-link.active {
            color: var(--lime);
            background: #303329;
            font-weight: 700;
        }

        .nav-icon {
            display: inline-grid;
            place-items: center;
            width: 20px;
            font-size: 17px;
        }

        .sidebar-bottom {
            margin-top: auto;
        }

        .user-card {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 16px 7px 0;
            border-top: 1px solid #33342e;
        }

        .avatar {
            display: grid;
            place-items: center;
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            color: var(--black);
            background: var(--lime);
            border-radius: 50%;
            font-size: 13px;
            font-weight: 800;
        }

        .user-name {
            overflow: hidden;
            max-width: 140px;
            color: #f1f2eb;
            font-size: 12px;
            font-weight: 700;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .user-role {
            margin-top: 4px;
            color: #92948a;
            font-size: 11px;
        }

        /* MAIN LAYOUT */

        .main {
            min-height: 100vh;
            margin-left: 250px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-height: 76px;
            padding: 15px 38px;
            background: rgba(255, 255, 255, 0.7);
            border-bottom: 1px solid var(--border);
        }

        .breadcrumbs {
            color: var(--muted);
            font-size: 12px;
        }

        .breadcrumbs strong {
            color: var(--text);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .topbar-label {
            color: var(--muted);
            font-size: 12px;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background: #8fbd38;
            border-radius: 50%;
        }

        .content {
            width: 100%;
            max-width: 1500px;
            margin: 0 auto;
            padding: 35px 38px 60px;
        }

        .page-heading {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 28px;
        }

        .eyebrow {
            margin-bottom: 10px;
            color: #74766d;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        h1 {
            margin: 0;
            font-size: clamp(28px, 3vw, 39px);
            font-weight: 800;
            letter-spacing: -1.8px;
        }

        .page-description {
            margin: 10px 0 0;
            color: #77796f;
            font-size: 13px;
            line-height: 1.7;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 42px;
            padding: 0 15px;
            border: 1px solid var(--border);
            border-radius: 10px;
            background: white;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .back-link:hover {
            border-color: #b8baad;
        }

        /* NOTICES AND ERRORS */

        .notice {
            margin-bottom: 22px;
            padding: 14px 16px;
            border: 1px solid #b8d68a;
            border-radius: 10px;
            background: #f1f9e6;
            color: #315b14;
            font-size: 13px;
        }

        .error-summary {
            margin-bottom: 22px;
            padding: 16px 18px;
            border: 1px solid #efc3bf;
            border-radius: 10px;
            background: #fff2f0;
            color: var(--danger);
            font-size: 13px;
        }

        .error-summary strong {
            display: block;
            margin-bottom: 8px;
        }

        .error-summary ul {
            margin: 0;
            padding-left: 20px;
            line-height: 1.8;
        }

        /* EDITOR GRID */

        .editor-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 290px;
            align-items: start;
            gap: 22px;
        }

        .editor-main,
        .editor-aside {
            display: grid;
            gap: 20px;
            min-width: 0;
        }

        .panel {
            min-width: 0;
            padding: 25px;
            background: var(--white);
            border: 1px solid var(--border);
            border-radius: var(--radius);
        }

        .panel-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 24px;
        }

        .panel-kicker {
            margin-bottom: 6px;
            color: #8a8c82;
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 1.7px;
        }

        .panel-title {
            margin: 0;
            font-size: 17px;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .panel-note {
            color: #8a8c82;
            font-size: 11px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 21px 18px;
        }

        .field {
            min-width: 0;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        .field label,
        .field-label {
            display: block;
            margin-bottom: 9px;
            color: #383a34;
            font-size: 12px;
            font-weight: 750;
        }

        .optional {
            margin-left: 5px;
            color: #999b92;
            font-size: 10px;
            font-weight: 500;
        }

        .input,
        .select,
        .textarea {
            display: block;
            width: 100%;
            min-width: 0;
            padding: 12px 13px;
            color: var(--text);
            background: #fff;
            border: 1px solid #dedfd7;
            border-radius: 9px;
            outline: none;
            font-size: 12px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .input,
        .select {
            min-height: 44px;
        }

        .textarea {
            min-height: 120px;
            resize: vertical;
            line-height: 1.7;
        }

        .input::placeholder,
        .textarea::placeholder {
            color: #a3a59b;
        }

        .input:focus,
        .select:focus,
        .textarea:focus {
            border-color: #a6c956;
            box-shadow: 0 0 0 3px rgba(215, 255, 100, 0.2);
        }

        .input.is-invalid,
        .select.is-invalid,
        .textarea.is-invalid {
            border-color: #d92d20;
        }

        .help {
            margin: 8px 0 0;
            color: #8a8c82;
            font-size: 10px;
            line-height: 1.7;
        }

        .field-error {
            margin-top: 7px;
            color: var(--danger);
            font-size: 11px;
        }

        .slug-wrapper {
            display: flex;
            align-items: center;
            min-width: 0;
            overflow: hidden;
            border: 1px solid #dedfd7;
            border-radius: 9px;
        }

        .slug-prefix {
            padding: 0 11px;
            color: #898b81;
            font-size: 11px;
            white-space: nowrap;
        }

        .slug-wrapper .input {
            min-width: 0;
            border: 0;
            border-left: 1px solid #e8e9e2;
            border-radius: 0;
            box-shadow: none;
        }

        .slug-wrapper:focus-within {
            border-color: #a6c956;
            box-shadow: 0 0 0 3px rgba(215, 255, 100, 0.2);
        }

        .slug-wrapper:focus-within .input {
            border-left-color: #e8e9e2;
        }

        /* MEDIA */

        .upload-box {
            display: grid;
            place-items: center;
            gap: 10px;
            min-height: 150px;
            padding: 22px;
            text-align: center;
            background: #fafbf7;
            border: 1px dashed #c9cbc0;
            border-radius: 11px;
        }

        .upload-icon {
            display: grid;
            place-items: center;
            width: 42px;
            height: 42px;
            color: #4e5e2e;
            background: #eff7df;
            border-radius: 12px;
            font-size: 22px;
        }

        .upload-title {
            font-size: 12px;
            font-weight: 750;
        }

        .upload-description {
            color: #8a8c82;
            font-size: 10px;
            line-height: 1.7;
        }

        /* EDITOR TOOLBAR */

        .rich-editor {
            overflow: hidden;
            border: 1px solid #dedfd7;
            border-radius: 10px;
        }

        .toolbar {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            padding: 9px;
            background: #fafbf7;
            border-bottom: 1px solid #e5e6de;
        }

        .tool-button {
            display: grid;
            place-items: center;
            min-width: 30px;
            height: 29px;
            padding: 0 7px;
            color: #5d5f56;
            background: white;
            border: 1px solid #e7e8e1;
            border-radius: 5px;
            cursor: pointer;
            font-size: 11px;
        }

        .tool-button:hover {
            background: var(--lime);
        }

        .editor-area {
            min-height: 155px;
            padding: 15px;
            outline: none;
            font-size: 12px;
            line-height: 1.8;
        }

        .editor-area:empty::before {
            content: attr(data-placeholder);
            color: #a3a59b;
        }

        /* RELATIONS */

        .select[multiple] {
            min-height: 135px;
            padding: 7px;
        }

        .select[multiple] option {
            padding: 8px;
            border-radius: 5px;
        }

        .select[multiple] option:checked {
            color: #222;
            background: #e9f7c8 linear-gradient(0deg, #e9f7c8 0%, #e9f7c8 100%);
        }

        /* JSON AND SEO */

        .code-editor {
            min-height: 130px;
            color: #dbe8be;
            background: #20221d;
            border-color: #20221d;
            font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
            font-size: 11px;
        }

        .seo-preview {
            padding: 15px;
            background: #fafbf7;
            border: 1px solid var(--border);
            border-radius: 9px;
        }

        .seo-url {
            margin-bottom: 7px;
            color: #48804b;
            font-size: 10px;
            overflow-wrap: anywhere;
        }

        .seo-title {
            margin-bottom: 6px;
            color: #3157a4;
            font-size: 14px;
            line-height: 1.5;
        }

        .seo-description {
            color: #65675e;
            font-size: 11px;
            line-height: 1.6;
        }

        /* PUBLISHING */

        .status-option {
            display: flex;
            align-items: flex-start;
            gap: 11px;
            padding: 13px;
            border: 1px solid var(--border);
            border-radius: 10px;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .status-option+.status-option {
            margin-top: 9px;
        }

        .status-option:has(input:checked) {
            background: #fbfdf4;
            border-color: #b3cf78;
        }

        .status-option input {
            margin-top: 3px;
            accent-color: #779a30;
        }

        .status-name {
            font-size: 12px;
            font-weight: 750;
        }

        .status-description {
            margin-top: 5px;
            color: #85877e;
            font-size: 10px;
            line-height: 1.6;
        }

        .aside-divider {
            height: 1px;
            margin: 20px 0;
            background: var(--border);
        }

        .aside-label {
            display: block;
            margin-bottom: 8px;
            color: #85877e;
            font-size: 10px;
            font-weight: 750;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .aside-value {
            color: #383a34;
            font-size: 12px;
            line-height: 1.7;
            overflow-wrap: anywhere;
        }

        .aside-tip {
            padding: 13px;
            color: #535a41;
            background: #f4f8e9;
            border-radius: 9px;
            font-size: 11px;
            line-height: 1.7;
        }

        /* FOOTER ACTIONS */

        .form-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            margin-top: 25px;
            padding-top: 23px;
            border-top: 1px solid var(--border);
        }

        .actions-note {
            color: #85877e;
            font-size: 11px;
            line-height: 1.6;
        }

        .actions-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 43px;
            padding: 0 17px;
            border: 1px solid transparent;
            border-radius: 9px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 800;
            transition: 0.2s ease;
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: wait;
        }

        .btn-secondary {
            color: #363831;
            background: white;
            border-color: #dedfd7;
        }

        .btn-secondary:hover {
            background: #f6f7f1;
        }

        .btn-primary {
            color: #1e2117;
            background: var(--lime);
        }

        .btn-primary:hover {
            background: #c8f052;
            transform: translateY(-1px);
        }

        .mobile-menu-button {
            display: none;
            width: 40px;
            height: 40px;
            color: var(--text);
            background: white;
            border: 1px solid var(--border);
            border-radius: 9px;
            cursor: pointer;
            font-size: 20px;
        }

        .sidebar-overlay {
            display: none;
        }

        /* RESPONSIVE */

        @media (max-width: 1200px) {
            .editor-layout {
                grid-template-columns: minmax(0, 1fr) 260px;
            }

            .content {
                padding-right: 25px;
                padding-left: 25px;
            }

            .topbar {
                padding-right: 25px;
                padding-left: 25px;
            }
        }

        @media (max-width: 980px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main {
                margin-left: 0;
            }

            .mobile-menu-button {
                display: inline-grid;
                place-items: center;
            }

            .topbar {
                gap: 15px;
            }

            .sidebar-overlay.visible {
                position: fixed;
                inset: 0;
                z-index: 90;
                display: block;
                background: rgba(0, 0, 0, 0.45);
            }

            .editor-layout {
                grid-template-columns: 1fr;
            }

            .editor-aside {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                align-items: start;
            }
        }

        @media (max-width: 640px) {
            .topbar {
                min-height: 65px;
                padding: 12px 16px;
            }

            .content {
                padding: 25px 15px 40px;
            }

            .page-heading {
                flex-direction: column;
                align-items: stretch;
            }

            .back-link {
                align-self: flex-start;
            }

            .panel {
                padding: 18px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 19px;
            }

            .field.full {
                grid-column: auto;
            }

            .editor-aside {
                grid-template-columns: 1fr;
            }

            .form-actions {
                align-items: stretch;
                flex-direction: column;
            }

            .actions-buttons {
                display: grid;
                grid-template-columns: 1fr 1fr;
            }

            .actions-buttons .btn {
                padding: 0 10px;
            }

            .topbar-label {
                display: none;
            }

            .slug-prefix {
                padding: 0 8px;
                font-size: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="app">

        {{-- SIDEBAR --}}
        <aside class="sidebar" id="sidebar">
            <a href="{{ route('dashboard') }}" class="brand">
                <div class="brand-mark">W</div>
                <div>
                    <div class="brand-name">WebLabStudios</div>
                    <div class="brand-caption">Control Center</div>
                </div>
            </a>

            <div class="nav-label">Workspace</div>

            <nav class="nav">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <span class="nav-icon">⌂</span>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('projects.index') }}" class="nav-link active">
                    <span class="nav-icon">▦</span>
                    <span>Projects</span>
                </a>

                <a href="{{ route('projects.create') }}" class="nav-link active">
                    <span class="nav-icon">＋</span>
                    <span>Create Project</span>
                </a>
            </nav>

            <div class="sidebar-bottom">
                <div class="nav-label">Account</div>

                <nav class="nav">
                    @if (Route::has('profile.edit'))
                        <a href="{{ route('profile.edit') }}" class="nav-link">
                            <span class="nav-icon">⚙</span>
                            <span>Settings</span>
                        </a>
                    @endif
                </nav>

                <div class="user-card">
                    <div class="avatar">
                        {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </div>

                    <div>
                        <div class="user-name">
                            {{ auth()->user()->name ?? 'Administrator' }}
                        </div>
                        <div class="user-role">Workspace Admin</div>
                    </div>
                </div>
            </div>
        </aside>

        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        {{-- MAIN --}}
        <main class="main">

            <header class="topbar">
                <div style="display:flex;align-items:center;gap:13px;">
                    <button class="mobile-menu-button" type="button" id="mobileMenuButton"
                        aria-label="Open navigation">☰</button>

                    <div class="breadcrumbs">
                        Workspace &nbsp;/&nbsp;
                        <a href="{{ route('projects.index') }}">Projects</a>
                        &nbsp;/&nbsp;
                        <strong>Create</strong>
                    </div>
                </div>

                <div class="topbar-right">
                    <span class="status-dot"></span>
                    <span class="topbar-label">Workspace is ready</span>
                </div>
            </header>

            <div class="content">

                {{-- PAGE HEADING --}}
                <div class="page-heading">
                    <div>
                        <div class="eyebrow">PROJECT MANAGEMENT</div>
                        <h1>Create project<span style="color:#a0bd55;">.</span></h1>
                        <p class="page-description">
                            Add project details, connect services and organize related content.
                        </p>
                    </div>

                    <a href="{{ route('projects.index') }}" class="back-link">
                        <span>←</span>
                        <span>All projects</span>
                    </a>
                </div>

                {{-- SUCCESS MESSAGE --}}
                @if (session('success'))
                    <div class="notice">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- VALIDATION ERRORS --}}
                @if ($errors->any())
                    <div class="error-summary">
                        <strong>Please check the following fields:</strong>

                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- PROJECT FORM --}}
                <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="editor-layout">

                        {{-- MAIN COLUMN --}}
                        <div class="editor-main">

                            {{-- BASIC INFORMATION --}}
                            <section class="panel">
                                <div class="panel-heading">
                                    <div>
                                        <div class="panel-kicker">01 / CONTENT</div>
                                        <h2 class="panel-title">Project information</h2>
                                    </div>

                                    <span class="panel-note">Required fields *</span>
                                </div>

                                <div class="form-grid">

                                    <div class="field full">
                                        <label for="title">
                                            Project title <span>*</span>
                                        </label>

                                        <input class="input @error('title') is-invalid @enderror" type="text"
                                            id="title" name="title" value="{{ old('title') }}"
                                            placeholder="e.g. Modern E-commerce Platform" maxlength="255" required
                                            autofocus>

                                        @error('title')
                                            <div class="field-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="field full">
                                        <label for="slug">
                                            URL slug <span>*</span>
                                        </label>

                                        <div class="slug-wrapper">
                                            <span class="slug-prefix">/projects/</span>

                                            <input class="input @error('slug') is-invalid @enderror" type="text"
                                                id="slug" name="slug" value="{{ old('slug') }}"
                                                placeholder="modern-ecommerce-platform" maxlength="255"
                                                pattern="[a-z0-9]+(-[a-z0-9]+)*"
                                                title="Use lowercase English letters, numbers and hyphens." required>
                                        </div>

                                        <p class="help">
                                            Use lowercase English letters, numbers and hyphens.
                                            You can edit the slug manually.
                                        </p>

                                        @error('slug')
                                            <div class="field-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="field">
                                        <label for="client_name">
                                            Client name
                                            <span class="optional">OPTIONAL</span>
                                        </label>

                                        <input class="input @error('client_name') is-invalid @enderror" type="text"
                                            id="client_name" name="client_name" value="{{ old('client_name') }}"
                                            placeholder="e.g. Acme Corporation" maxlength="255">

                                        @error('client_name')
                                            <div class="field-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="field">
                                        <label for="project_url">
                                            Project website
                                            <span class="optional">OPTIONAL</span>
                                        </label>

                                        <input class="input @error('project_url') is-invalid @enderror" type="url"
                                            id="project_url" name="project_url" value="{{ old('project_url') }}"
                                            placeholder="https://example.com" maxlength="255">

                                        @error('project_url')
                                            <div class="field-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="field full">
                                        <label for="description">
                                            Project description
                                            <span class="optional">OPTIONAL</span>
                                        </label>

                                        <textarea class="textarea @error('description') is-invalid @enderror" id="description" name="description"
                                            maxlength="5000" placeholder="Describe the project, its goals, the challenge and the solution...">{{ old('description') }}</textarea>

                                        <p class="help">
                                            Maximum 5,000 characters.
                                        </p>

                                        @error('description')
                                            <div class="field-error">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>
                            </section>

                            {{-- COVER MEDIA --}}
                            <section class="panel">
                                <div class="panel-heading">
                                    <div>
                                        <div class="panel-kicker">02 / MEDIA</div>
                                        <h2 class="panel-title">Cover media</h2>
                                    </div>

                                    <span class="panel-note">Optional</span>
                                </div>

                                <div class="field">
    <label for="image">Cover image URL</label>

    <input
        class="input @error('image') is-invalid @enderror"
        type="text"
        id="image"
        name="image"
        value="{{ old('image') }}"
        placeholder="https://example.com/images/project.jpg"
        maxlength="255"
    >

    <p class="help">
        Enter an external image URL, or upload an image from your device below.
    </p>

    @error('image')
        <div class="field-error">{{ $message }}</div>
    @enderror
</div>

<div class="field">
    <label for="image_file">Upload Cover Image</label>

    <input
        class="input @error('image_file') is-invalid @enderror"
        type="file"
        id="image_file"
        name="image_file"
        accept="image/jpeg,image/png,image/webp"
    >

    <p class="help">
        Accepted formats: JPG, PNG, WebP. Maximum size: 5 MB.
        If you upload a file, it will take priority over the external URL.
    </p>

    @error('image_file')
        <div class="field-error">{{ $message }}</div>
    @enderror
</div>

                                <div class="upload-box" style="margin-top:16px;">
                                    <div class="upload-icon">▧</div>

                                    <div class="upload-title">Cover image preview</div>

                                    <div class="upload-description">
                                        Enter an image URL above to preview it here.
                                    </div>

                                    <img id="coverPreview" alt="Project cover preview"
                                        style="display:none;max-width:100%;max-height:240px;border-radius:8px;object-fit:contain;">

                                    <div id="coverPreviewError" class="upload-description" style="display:none;">
                                        Unable to load this image. Check the URL or path.
                                    </div>
                                </div>
                            </section>

                            {{-- DESCRIPTION EDITOR --}}
                            <section class="panel">
                                <div class="panel-heading">
                                    <div>
                                        <div class="panel-kicker">03 / EDITOR</div>
                                        <h2 class="panel-title">Description editor</h2>
                                    </div>

                                    <span class="panel-note">Visual preview</span>
                                </div>

                                <div class="rich-editor">
                                    <div class="toolbar">
                                        <button class="tool-button" type="button" data-command="bold">
                                            <strong>B</strong>
                                        </button>

                                        <button class="tool-button" type="button" data-command="italic">
                                            <em>I</em>
                                        </button>

                                        <button class="tool-button" type="button" data-command="underline">
                                            <u>U</u>
                                        </button>

                                        <button class="tool-button" type="button"
                                            data-command="insertUnorderedList">
                                            • List
                                        </button>

                                        <button class="tool-button" type="button" data-command="formatBlock"
                                            data-value="h3">
                                            H3
                                        </button>

                                        <button class="tool-button" type="button" data-command="formatBlock"
                                            data-value="p">
                                            Paragraph
                                        </button>
                                    </div>

                                    <div class="editor-area" id="visualEditor" contenteditable="true"
                                        data-placeholder="Write or preview your project content here...">
                                        {{ old('description') }}</div>
                                </div>

                                <p class="help">
                                    This editor is a visual-only preview. Its formatted content
                                    is not saved to the database. Use the Project description
                                    field above to save text.
                                </p>
                            </section>

                            {{-- RELATIONS --}}
                          <section class="panel">
    <div class="panel-heading">
        <div>
            <div class="panel-kicker">04 / RELATIONS</div>
            <h2 class="panel-title">Connect this content</h2>
        </div>
        <span class="panel-note">Optional</span>
    </div>

    <div class="form-grid">
        {{-- Related Content --}}
        <div class="field">
            <label for="related_project_ids">Related Content</label>
            <select
                class="select"
                id="related_project_ids"
                name="related_project_ids[]"
                multiple
                size="5"
            >
                @foreach ($relatedProjects as $relatedProject)
                    <option
                        value="{{ $relatedProject->id }}"
                        @selected(in_array(
                            $relatedProject->id,
                            array_map('intval', old('related_project_ids', []))
                        ))
                    >
                        {{ $relatedProject->title }}
                    </option>
                @endforeach
            </select>
            <p class="help">Hold Command on Mac or Ctrl on Windows to select multiple projects.</p>
            @error('related_project_ids.*')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- Services --}}
        <div class="field">
            <label for="service_ids">Services used</label>
            <select
                class="select"
                id="service_ids"
                name="service_ids[]"
                multiple
                size="5"
            >
                @foreach ($services as $service)
                    <option
                        value="{{ $service->id }}"
                        @selected(in_array(
                            $service->id,
                            array_map('intval', old('service_ids', []))
                        ))
                    >
                        {{ $service->name }}
                    </option>
                @endforeach
            </select>
            <p class="help">Choose the services used for this project.</p>
            @error('service_ids.*')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- Author --}}
        <div class="field">
            <label for="author_id">Author</label>
            <select class="select" id="author_id" name="author_id">
                <option value="">Not assigned</option>
                @foreach ($authors as $author)
                    <option
                        value="{{ $author->id }}"
                        @selected((string) old('author_id', auth()->id()) === (string) $author->id)
                    >
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
            @error('author_id')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- Category --}}
        <div class="field">
            <label for="category_id">Category</label>
            <select class="select" id="category_id" name="category_id">
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
            @error('category_id')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- Tags --}}
        <div class="field">
            <label for="tag_ids">Tags</label>
            <select
                class="select"
                id="tag_ids"
                name="tag_ids[]"
                multiple
                size="5"
            >
                @foreach ($tags as $tag)
                    <option
                        value="{{ $tag->id }}"
                        @selected(in_array(
                            $tag->id,
                            array_map('intval', old('tag_ids', []))
                        ))
                    >
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>
            <p class="help">Hold Command on Mac or Ctrl on Windows to select multiple tags.</p>
            @error('tag_ids.*')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>

        {{-- Markets --}}
        <div class="field">
            <label for="market_ids">Markets</label>
            <select
                class="select"
                id="market_ids"
                name="market_ids[]"
                multiple
                size="5"
            >
                @foreach ($markets as $market)
                    <option
                        value="{{ $market->id }}"
                        @selected(in_array(
                            $market->id,
                            array_map('intval', old('market_ids', []))
                        ))
                    >
                        {{ $market->name }}
                    </option>
                @endforeach
            </select>
            <p class="help">Hold Command on Mac or Ctrl on Windows to select multiple markets.</p>
            @error('market_ids.*')
                <div class="field-error">{{ $message }}</div>
            @enderror
        </div>
    </div>
</section>

                            {{-- JSON --}}
                            <section class="panel">
                                <div class="panel-heading">
                                    <div>
                                        <div class="panel-kicker">05 / ADVANCED</div>
                                        <h2 class="panel-title">Structured data</h2>
                                    </div>

                                    <span class="panel-note">Preview only</span>
                                </div>

                                <div class="field">
                                    <label for="json_preview">JSON metadata</label>

                                    <textarea class="textarea code-editor" id="json_preview" spellcheck="false" disabled>{
  "content_type": "project",
  "platform": "WebLabStudios"
}</textarea>

                                    <p class="help">
                                        This is a visual example only. JSON metadata is not saved.
                                    </p>
                                </div>
                            </section>

                            {{-- SEO --}}
                            <section class="panel">
                                <div class="panel-heading">
                                    <div>
                                        <div class="panel-kicker">06 / DISCOVERY</div>
                                        <h2 class="panel-title">SEO preview</h2>
                                    </div>

                                    <span class="panel-note">Live preview</span>
                                </div>

                                <div class="field">
                                    <label for="seo_title">Search result title</label>

                                    <input class="input" type="text" id="seo_title" maxlength="255"
                                        placeholder="Project title">
                                </div>

                                <div class="field" style="margin-top:18px;">
                                    <label for="seo_description">Search result description</label>

                                    <textarea class="textarea" id="seo_description" maxlength="300" placeholder="A short summary for search engines..."></textarea>
                                </div>

                                <div class="seo-preview" style="margin-top:18px;">
                                    <div class="seo-url">
                                        WebLabStudios / projects /
                                        <span id="seoSlug">your-project</span>
                                    </div>

                                    <div class="seo-title" id="seoPreviewTitle">
                                        Your project title
                                    </div>

                                    <div class="seo-description" id="seoPreviewDescription">
                                        Your project description will appear here.
                                    </div>
                                </div>

                                <p class="help">
                                    SEO fields are previews only and are not saved to the database.
                                </p>
                            </section>

                        </div>

                        {{-- SIDEBAR COLUMN --}}
                        <aside class="editor-aside">

                            {{-- PUBLISHING --}}
                            <section class="panel">
                                <div class="panel-heading">
                                    <div>
                                        <div class="panel-kicker">PUBLISHING</div>
                                        <h2 class="panel-title">Status</h2>
                                    </div>
                                </div>

                                <label class="status-option">
                                    <input type="radio" name="status_preview" value="draft" checked>

                                    <span>
                                        <span class="status-name">Draft</span>

                                        <span class="status-description" style="display:block;">
                                            Keep the project unpublished while you work.
                                        </span>
                                    </span>
                                </label>

                                <label class="status-option">
                                    <input type="radio" name="status_preview" value="published">

                                    <span>
                                        <span class="status-name">Published</span>

                                        <span class="status-description" style="display:block;">
                                            Mark the project as published.
                                        </span>
                                    </span>
                                </label>

                                <div class="aside-divider"></div>

                                <span class="aside-label">Current action</span>

                                <div class="aside-value" id="statusSummary">
                                    Save this project as a draft.
                                </div>

                                <div class="aside-divider"></div>

                                <div class="aside-tip">
                                    <strong>Tip:</strong>
                                    Review the title, URL slug, services and related content
                                    before publishing.
                                </div>
                            </section>

                            {{-- LOCALE --}}
                            <section class="panel">
                                <div class="panel-heading">
                                    <div>
                                        <div class="panel-kicker">LANGUAGE</div>
                                        <h2 class="panel-title">Locale</h2>
                                    </div>
                                </div>

                                <div class="field">
                                    <label for="locale">Content language</label>

                                    <select class="select" id="locale">
                                        <option value="en">English</option>
                                        <option value="ar">Arabic</option>
                                        <option value="tr">Turkish</option>
                                    </select>

                                    <p class="help">
                                        Display only. Language selection is not saved yet.
                                    </p>
                                </div>

                                <div class="aside-divider"></div>

                                <span class="aside-label">Translation</span>

                                <div class="aside-value">
                                    Translation management is not connected yet.
                                </div>
                            </section>

                            {{-- SUMMARY --}}
                            <section class="panel">
                                <div class="panel-heading">
                                    <div>
                                        <div class="panel-kicker">CHECKLIST</div>
                                        <h2 class="panel-title">Before saving</h2>
                                    </div>
                                </div>

                                <div class="aside-value" style="display:grid;gap:12px;">
                                    <div>○ Add a project title</div>
                                    <div>○ Check the URL slug</div>
                                    <div>○ Add a description</div>
                                    <div>○ Select relevant services</div>
                                    <div>○ Choose related projects</div>
                                </div>
                            </section>

                        </aside>
                    </div>

                    {{-- ACTIONS --}}
                    <div class="form-actions">
                        <div class="actions-note">
                            Required fields are marked with an asterisk (*).<br>
                            Your project will be saved to the database.
                        </div>

                        <div class="actions-buttons">
                            <a href="{{ route('projects.index') }}" class="btn btn-secondary">
                                Cancel
                            </a>

                            <button type="submit" class="btn btn-secondary" name="status" value="draft"
                                id="saveDraftButton">
                                Save draft
                            </button>

                            <button type="submit" class="btn btn-primary" name="status" value="published"
                                id="publishButton">
                                Publish project ↗
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </main>
    </div>

    <script>
        // MOBILE SIDEBAR
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const menuButton = document.getElementById('mobileMenuButton');

        function openSidebar() {
            sidebar.classList.add('open');
            overlay.classList.add('visible');
        }

        function closeSidebar() {
            sidebar.classList.remove('open');
            overlay.classList.remove('visible');
        }

        menuButton?.addEventListener('click', () => {
            if (sidebar.classList.contains('open')) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });

        overlay.addEventListener('click', closeSidebar);

        // AUTOMATIC SLUG GENERATION
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');

        let slugManuallyEdited = slugInput.value.trim() !== '';

        slugInput.addEventListener('input', () => {
            slugManuallyEdited = slugInput.value.trim() !== '';
        });

        function slugify(value) {
            return value
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/^-+|-+$/g, '');
        }

        titleInput.addEventListener('input', () => {
            if (!slugManuallyEdited) {
                slugInput.value = slugify(titleInput.value);
            }
        });

        // VISUAL EDITOR TOOLBAR
        const visualEditor = document.getElementById('visualEditor');

        document.querySelectorAll('[data-command]').forEach(button => {
            button.addEventListener('click', () => {
                const command = button.dataset.command;
                const value = button.dataset.value || null;

                visualEditor.focus();

                document.execCommand(command, false, value);
            });
        });

        // COVER IMAGE PREVIEW
        const imageInput = document.getElementById('image');
        const coverPreview = document.getElementById('coverPreview');
        const coverPreviewError = document.getElementById('coverPreviewError');

        function updateCoverPreview() {
            const value = imageInput.value.trim();

            coverPreview.style.display = 'none';
            coverPreviewError.style.display = 'none';

            if (!value || !/^https?:\/\//i.test(value)) {
                return;
            }

            coverPreview.onload = () => {
                coverPreview.style.display = 'block';
                coverPreviewError.style.display = 'none';
            };

            coverPreview.onerror = () => {
                coverPreview.style.display = 'none';
                coverPreviewError.style.display = 'block';
            };

            coverPreview.src = value;
        }

        imageInput.addEventListener('input', updateCoverPreview);

        updateCoverPreview();

        // SEO LIVE PREVIEW
        const seoTitle = document.getElementById('seo_title');
        const seoDescription = document.getElementById('seo_description');
        const seoPreviewTitle = document.getElementById('seoPreviewTitle');
        const seoPreviewDescription = document.getElementById('seoPreviewDescription');
        const seoSlug = document.getElementById('seoSlug');

        function updateSeoPreview() {
            seoPreviewTitle.textContent =
                seoTitle.value.trim() || titleInput.value.trim() || 'Your project title';

            seoPreviewDescription.textContent =
                seoDescription.value.trim() ||
                document.getElementById('description').value.trim() ||
                'Your project description will appear here.';

            seoSlug.textContent = slugInput.value.trim() || 'your-project';
        }

        titleInput.addEventListener('input', updateSeoPreview);
        slugInput.addEventListener('input', updateSeoPreview);
        seoTitle.addEventListener('input', updateSeoPreview);
        seoDescription.addEventListener('input', updateSeoPreview);

        document.getElementById('description').addEventListener('input', updateSeoPreview);

        updateSeoPreview();

        // PUBLISHING STATUS PREVIEW
        const statusRadios = document.querySelectorAll('input[name="status_preview"]');
        const statusSummary = document.getElementById('statusSummary');

        statusRadios.forEach(radio => {
            radio.addEventListener('change', () => {
                statusSummary.textContent = radio.value === 'published' ?
                    'This project will be published.' :
                    'Save this project as a draft.';
            });
        });

        // ACTUAL FORM SUBMISSION
        // The clicked button sends its own "status" value to Laravel.
        // ACTUAL FORM SUBMISSION
        const projectForm = document.getElementById('projectForm');
        const saveDraftButton = document.getElementById('saveDraftButton');
        const publishButton = document.getElementById('publishButton');

        function addStatusToForm(status) {
            let statusInput = projectForm.querySelector('input[name="status"]');

            if (!statusInput) {
                statusInput = document.createElement('input');
                statusInput.type = 'hidden';
                statusInput.name = 'status';
                projectForm.appendChild(statusInput);
            }

            statusInput.value = status;
        }

        saveDraftButton.addEventListener('click', function() {
            addStatusToForm('draft');
        });

        publishButton.addEventListener('click', function() {
            addStatusToForm('published');
        });

        projectForm.addEventListener('submit', function(event) {
            const submitter = event.submitter;

            if (submitter && submitter.value === 'draft') {
                addStatusToForm('draft');
            } else if (submitter && submitter.value === 'published') {
                addStatusToForm('published');
            }
        });
    </script>
</body>

</html>
