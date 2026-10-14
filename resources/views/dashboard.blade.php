```blade
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CMS Admin | WebLabStudios</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --sidebar: #11120f;
            --paper: #f5f5ef;
            --card: #fffefa;
            --ink: #171815;
            --muted: #777970;
            --line: #e1e1d8;
            --lime: #c5ff45;
            --sidebar-width: 230px;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html {
            width: 100%;
            min-width: 0;
            scroll-behavior: smooth;
            overflow-x: clip;
        }

        body {
            width: 100%;
            min-width: 0;
            margin: 0;
            overflow-x: clip;
            background: var(--paper);
            color: var(--ink);
            font-family: Arial, Helvetica, sans-serif;
            font-size: 14px;
        }

        body.menu-open {
            overflow: hidden;
        }

        button,
        input {
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

        button {
            cursor: pointer;
        }

        .admin-layout {
            width: 100%;
            min-width: 0;
            min-height: 100vh;
        }

        /* Sidebar */

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 100;
            display: flex;
            flex-direction: column;
            width: var(--sidebar-width);
            height: 100vh;
            height: 100dvh;
            overflow-y: auto;
            padding: 25px 15px 18px;
            background: var(--sidebar);
            color: #f5f5ef;
            scrollbar-width: thin;
            scrollbar-color: #45463e var(--sidebar);
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 32px;
            padding: 0 8px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
        }

        .brand-mark {
            display: grid;
            place-items: center;
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            background: var(--lime);
            color: var(--ink);
            font-size: 12px;
            font-weight: 900;
        }

        .brand-name {
            font-size: 16px;
            font-weight: 700;
            letter-spacing: -0.5px;
        }

        .brand-caption {
            margin-top: 5px;
            color: #8e9086;
            font-size: 9px;
            letter-spacing: 1.3px;
        }

        .sidebar-close {
            display: none;
            width: 40px;
            height: 40px;
            border: 0;
            background: transparent;
            color: white;
            font-size: 30px;
            line-height: 1;
        }

        .nav-label {
            margin: 0 0 12px;
            padding: 0 10px;
            color: #77796f;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.2px;
        }

        .nav-list {
            display: grid;
            gap: 5px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 13px;
            width: 100%;
            min-width: 0;
            min-height: 42px;
            padding: 0 10px;
            border: 0;
            border-radius: 6px;
            background: transparent;
            color: #dedfd7;
            text-align: left;
            font-size: 13px;
            transition: background 0.15s, color 0.15s;
        }

        .nav-link:hover {
            background: #24261f;
            color: white;
        }

        .nav-link.active {
            background: #25291d;
            color: var(--lime);
        }

        .nav-icon {
            width: 17px;
            flex-shrink: 0;
            text-align: center;
            font-size: 11px;
            font-weight: 700;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 18px;
            border-top: 1px solid #303129;
        }

        .sidebar-bottom form {
            margin: 0;
        }

        .signout:hover {
            color: var(--lime);
        }

        /* Mobile navigation */

        .mobile-menu-button {
            display: none;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border: 1px solid #292a25;
            background: var(--sidebar);
            color: white;
            font-size: 24px;
        }

        .sidebar-overlay {
            position: fixed;
            inset: 0;
            z-index: 90;
            background: rgba(12, 13, 10, 0.48);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.25s ease, visibility 0.25s ease;
        }

        .sidebar-overlay.is-visible {
            opacity: 1;
            visibility: visible;
        }

        /* Main content */

        .main {
            width: auto;
            min-width: 0;
            min-height: 100vh;
            margin-left: var(--sidebar-width);
            padding: 0 42px 30px;
        }

        .topline {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            min-height: 64px;
            border-bottom: 1px solid var(--line);
            color: #85877e;
            font-size: 10px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .private-label {
            display: flex;
            align-items: center;
            gap: 8px;
            min-width: 0;
        }

        .top-user {
            max-width: 45%;
            color: #62645c;
            font-size: 11px;
            letter-spacing: 0;
            text-align: right;
            text-transform: none;
            overflow-wrap: anywhere;
        }

        .content {
            width: 100%;
            max-width: 1440px;
            min-width: 0;
            margin: 0 auto;
            padding-top: 58px;
        }

        .page-heading {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 30px;
        }

        .page-heading > div {
            min-width: 0;
        }

        .eyebrow {
            margin: 0 0 10px;
            color: #77796f;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .page-heading h1 {
            max-width: 850px;
            margin: 0;
            font-size: clamp(38px, 3.8vw, 64px);
            line-height: 1.04;
            font-weight: 500;
            letter-spacing: -2.8px;
            overflow-wrap: anywhere;
        }

        .page-description {
            max-width: 650px;
            margin: 14px 0 0;
            color: var(--muted);
            font-size: 15px;
            line-height: 1.7;
        }

        .refresh-button {
            display: grid;
            place-items: center;
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            border: 1px solid var(--line);
            background: transparent;
            color: var(--ink);
            font-size: 21px;
        }

        .refresh-button:hover {
            background: white;
        }

        /* Statistics */

        .stats {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 10px;
            width: 100%;
            margin-bottom: 10px;
        }

        .stat-card {
            display: flex;
            flex-direction: column;
            min-width: 0;
            min-height: 170px;
            padding: 18px;
            border: 1px solid var(--line);
            background: var(--card);
            transition: border-color 0.15s, transform 0.15s;
        }

        .stat-card:hover {
            border-color: #aeb69d;
            transform: translateY(-2px);
        }

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .stat-icon {
            display: grid;
            place-items: center;
            width: 36px;
            height: 36px;
            flex-shrink: 0;
            background: #eeeee6;
            font-size: 19px;
        }

        .stat-arrow {
            font-size: 20px;
        }

        .stat-name {
            margin-top: auto;
            padding-top: 22px;
            color: var(--muted);
            font-size: 12px;
        }

        .stat-number {
            margin-top: 6px;
            font-size: 36px;
            line-height: 1;
            font-weight: 700;
            letter-spacing: -1px;
        }

        /* Lower panels */

        .lower-grid {
            display: grid;
            grid-template-columns: minmax(0, 1.15fr) minmax(0, 0.85fr);
            gap: 10px;
            width: 100%;
        }

        .panel {
            min-width: 0;
            border: 1px solid var(--line);
            background: var(--card);
        }

        .panel-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            min-height: 75px;
            padding: 18px 22px;
            border-bottom: 1px solid var(--line);
        }

        .panel-heading .eyebrow {
            margin-bottom: 6px;
            font-size: 10px;
        }

        .panel-title {
            margin: 0;
            font-size: 19px;
            font-weight: 500;
            overflow-wrap: anywhere;
        }

        .panel-tool {
            color: #85877e;
            font-size: 19px;
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .quick-action {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            min-width: 0;
            min-height: 52px;
            padding: 14px 22px;
            border-bottom: 1px solid var(--line);
            font-size: 13px;
            overflow-wrap: anywhere;
            transition: background 0.15s;
        }

        .quick-action:nth-child(odd) {
            border-right: 1px solid var(--line);
        }

        .quick-action:nth-last-child(-n+2) {
            border-bottom: 0;
        }

        .quick-action:hover {
            background: #f3f5e9;
        }

        .session-panel {
            padding: 0 22px;
        }

        .session-panel .panel-heading {
            padding-right: 0;
            padding-left: 0;
        }

        .session-content {
            padding: 18px 0;
        }

        .session-content p {
            margin: 0;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
        }

        .session-user {
            display: flex;
            align-items: center;
            gap: 9px;
            min-width: 0;
            padding: 16px 0 0;
            border-top: 1px solid var(--line);
            color: #77796f;
            font-size: 11px;
        }

        .session-email {
            min-width: 0;
            overflow-wrap: anywhere;
            word-break: break-word;
        }

        .status-dot {
            width: 7px;
            height: 7px;
            flex-shrink: 0;
            border-radius: 50%;
            background: #b9ec39;
        }

        .footer {
            padding: 22px 0 0;
            color: #96988f;
            text-align: center;
            font-size: 10px;
        }

        /* Medium screens */

        @media (max-width: 1200px) {
            :root {
                --sidebar-width: 205px;
            }

            .main {
                padding-right: 25px;
                padding-left: 25px;
            }

            .content {
                padding-top: 45px;
            }

            .stats {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .lower-grid {
                grid-template-columns: minmax(0, 1fr);
                gap: 12px;
            }
        }

        /* Mobile */

        @media (max-width: 760px) {
            .admin-layout {
                width: 100%;
                max-width: 100%;
                overflow-x: clip;
            }

            .mobile-menu-button {
                position: fixed;
                top: 14px;
                left: 14px;
                z-index: 80;
                display: inline-flex;
                box-shadow: 0 2px 12px rgba(0, 0, 0, 0.12);
            }

            .sidebar {
                width: min(86vw, 340px);
                max-width: 100%;
                padding: 18px 15px;
                transform: translateX(-102%);
                visibility: hidden;
                transition: transform 0.25s ease, visibility 0.25s ease;
            }

            .sidebar.is-open {
                transform: translateX(0);
                visibility: visible;
            }

            .sidebar-header {
                margin-bottom: 24px;
            }

            .sidebar-close {
                display: block;
            }

            .nav-link {
                min-height: 46px;
                font-size: 14px;
            }

            .main {
                width: 100%;
                min-width: 0;
                max-width: 100%;
                margin-left: 0;
                padding: 0 16px 24px;
            }

            .topline {
                width: 100%;
                min-height: 70px;
                gap: 8px;
                padding-left: 52px;
                font-size: 9px;
            }

            .private-label {
                min-width: 0;
                overflow-wrap: anywhere;
            }

            .top-user {
                max-width: 38%;
                overflow-wrap: anywhere;
            }

            .content {
                width: 100%;
                max-width: 100%;
                margin: 0;
                padding-top: 34px;
            }

            .page-heading {
                gap: 10px;
                margin-bottom: 25px;
            }

            .page-heading > div {
                flex: 1 1 0;
                min-width: 0;
            }

            .page-heading h1 {
                max-width: 100%;
                font-size: clamp(30px, 7.5vw, 44px);
                line-height: 1.1;
                letter-spacing: -1.5px;
                overflow-wrap: anywhere;
            }

            .page-description {
                max-width: 100%;
                font-size: 14px;
                line-height: 1.65;
                overflow-wrap: anywhere;
            }

            .refresh-button {
                width: 38px;
                height: 38px;
            }

            .stats {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 8px;
            }

            .stat-card {
                width: 100%;
                min-width: 0;
                min-height: 145px;
                padding: 13px;
            }

            .stat-icon {
                width: 34px;
                height: 34px;
            }

            .stat-name {
                padding-top: 18px;
            }

            .stat-number {
                font-size: 31px;
            }

            .lower-grid {
                grid-template-columns: minmax(0, 1fr);
                gap: 12px;
            }

            .panel {
                width: 100%;
                min-width: 0;
            }

            .panel-heading {
                padding: 16px;
            }

            .panel-title {
                font-size: 18px;
            }

            .session-panel {
                padding: 0 16px;
            }

            .quick-action {
                min-width: 0;
                padding: 14px 12px;
                overflow-wrap: anywhere;
            }

            .session-content p {
                overflow-wrap: anywhere;
            }

            .footer {
                padding-bottom: 12px;
            }
        }

        /* Small phones */

        @media (max-width: 390px) {
            .main {
                padding-right: 12px;
                padding-left: 12px;
            }

            .content {
                padding-top: 27px;
            }

            .page-heading h1 {
                font-size: 30px;
                letter-spacing: -1.2px;
            }

            .page-description {
                font-size: 13px;
            }

            .stats,
            .quick-actions {
                grid-template-columns: minmax(0, 1fr);
            }

            .stat-card {
                min-height: 125px;
            }

            .quick-action:nth-child(odd) {
                border-right: 0;
            }

            .quick-action:nth-last-child(2) {
                border-bottom: 1px solid var(--line);
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                transition-duration: 0.01ms !important;
                animation-duration: 0.01ms !important;
            }
        }
    </style>
</head>

<body>
<div class="admin-layout">

    <button
        type="button"
        class="mobile-menu-button"
        id="mobileMenuButton"
        aria-label="Open navigation"
        aria-controls="adminSidebar"
        aria-expanded="false"
    >☰</button>

    <div
        class="sidebar-overlay"
        id="sidebarOverlay"
        aria-hidden="true"
    ></div>

    <aside class="sidebar" id="adminSidebar" aria-label="Admin navigation">

        <div class="sidebar-header">
            <a href="{{ route('dashboard') }}" class="brand">
                <div class="brand-mark">WL</div>
                <div>
                    <div class="brand-name">WebLab</div>
                    <div class="brand-caption">STUDIOS / CMS</div>
                </div>
            </a>

            <button
                type="button"
                class="sidebar-close"
                id="sidebarClose"
                aria-label="Close navigation"
            >×</button>
        </div>

        <p class="nav-label">Workspace</p>

        <nav class="nav-list">
            <a href="{{ route('dashboard') }}" class="nav-link active">
                <span class="nav-icon">↗</span>
                <span>Overview</span>
            </a>

            <a href="#articles" class="nav-link">
                <span class="nav-icon">AR</span>
                <span>Articles</span>
            </a>

            <a href="{{ route('projects.index') }}" class="nav-link">
    <span class="nav-icon">PR</span>
    <span>Projects</span>
</a>

            <a href="#services" class="nav-link">
                <span class="nav-icon">SV</span>
                <span>Services</span>
            </a>

            <a href="#pages" class="nav-link">
                <span class="nav-icon">PG</span>
                <span>Pages</span>
            </a>

            <a href="#taxonomy" class="nav-link">
                <span class="nav-icon">TX</span>
                <span>Taxonomy</span>
            </a>

            <a href="#media" class="nav-link">
                <span class="nav-icon">MD</span>
                <span>Media</span>
            </a>

            <a href="#inquiries" class="nav-link">
                <span class="nav-icon">IN</span>
                <span>Inquiries</span>
            </a>

            <a href="#settings" class="nav-link">
                <span class="nav-icon">ST</span>
                <span>Settings</span>
            </a>

            <a href="#seo" class="nav-link">
                <span class="nav-icon">SE</span>
                <span>SEO</span>
            </a>
        </nav>

        <div class="sidebar-bottom">
            <a href="{{ url('/') }}" class="nav-link">
                <span class="nav-icon">↗</span>
                <span>View public site</span>
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="nav-link signout">
                    <span class="nav-icon">⇥</span>
                    <span>Sign out</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="main">

        <div class="topline">
            <div class="private-label">
                <span>♢</span>
                <span>Private workspace</span>
            </div>

            <div class="top-user">
                {{ auth()->user()->name }}
            </div>
        </div>

        <div class="content">

            <section class="page-heading">
                <div>
                    <p class="eyebrow">Overview / Admin</p>

                    <h1>
                        Good to see you,<br>
                        {{ auth()->user()->name }}.
                    </h1>

                    <p class="page-description">
                        A clear view of the content currently stored in the studio CMS.
                    </p>
                </div>

                <button
                    type="button"
                    class="refresh-button"
                    onclick="window.location.reload()"
                    aria-label="Refresh dashboard"
                    title="Refresh dashboard"
                >⟳</button>
            </section>

            <section class="stats" aria-label="CMS statistics">

                <a href="#articles" class="stat-card">
                    <div class="stat-top">
                        <span class="stat-icon">▤</span>
                        <span class="stat-arrow">↗</span>
                    </div>
                    <div class="stat-name">Articles</div>
                    <div class="stat-number">—</div>
                </a>

                <a href="#projects" class="stat-card">
                    <div class="stat-top">
                        <span class="stat-icon">▣</span>
                        <span class="stat-arrow">↗</span>
                    </div>
                    <div class="stat-name">Projects</div>
                    <div class="stat-number">—</div>
                </a>

                <a href="#services" class="stat-card">
                    <div class="stat-top">
                        <span class="stat-icon">▱</span>
                        <span class="stat-arrow">↗</span>
                    </div>
                    <div class="stat-name">Services</div>
                    <div class="stat-number">—</div>
                </a>

                <a href="#pages" class="stat-card">
                    <div class="stat-top">
                        <span class="stat-icon">▤</span>
                        <span class="stat-arrow">↗</span>
                    </div>
                    <div class="stat-name">Pages</div>
                    <div class="stat-number">—</div>
                </a>

                <a href="#inquiries" class="stat-card">
                    <div class="stat-top">
                        <span class="stat-icon">✉</span>
                        <span class="stat-arrow">↗</span>
                    </div>
                    <div class="stat-name">Inquiries</div>
                    <div class="stat-number">—</div>
                </a>

            </section>

            <section class="lower-grid">

                <div class="panel">
                    <div class="panel-heading">
                        <div>
                            <p class="eyebrow">Editorial flow</p>
                            <h2 class="panel-title">Start with a collection</h2>
                        </div>
                        <span class="panel-tool">☷</span>
                    </div>

                    <div class="quick-actions">
                        <a href="#articles" class="quick-action">
                            <span>New article</span>
                            <span>↗</span>
                        </a>

                        <a href="#projects" class="quick-action">
                            <span>New project</span>
                            <span>↗</span>
                        </a>

                        <a href="#services" class="quick-action">
                            <span>New service</span>
                            <span>↗</span>
                        </a>

                        <a href="#pages" class="quick-action">
                            <span>Edit a page</span>
                            <span>↗</span>
                        </a>
                    </div>
                </div>

                <div class="panel session-panel">
                    <div class="panel-heading">
                        <div>
                            <p class="eyebrow">Session</p>
                            <h2 class="panel-title">Administrator access</h2>
                        </div>
                    </div>

                    <div class="session-content">
                        <p>
                            This page is available to authenticated users.
                            Configure administrator permissions before using
                            this area for privileged content management.
                        </p>
                    </div>

                    <div class="session-user">
                        <span class="status-dot"></span>
                        <span class="session-email">
                            {{ auth()->user()->email }}
                        </span>
                    </div>
                </div>

            </section>

            <footer class="footer">
                © {{ date('Y') }} WebLabStudios. All rights reserved.
            </footer>

        </div>
    </main>
</div>

<script>
(() => {
    const sidebar = document.getElementById('adminSidebar');
    const menuButton = document.getElementById('mobileMenuButton');
    const closeButton = document.getElementById('sidebarClose');
    const overlay = document.getElementById('sidebarOverlay');

    if (!sidebar || !menuButton || !closeButton || !overlay) {
        return;
    }

    function isMobile() {
        return window.matchMedia('(max-width: 760px)').matches;
    }

    function openSidebar() {
        if (!isMobile()) return;

        sidebar.classList.add('is-open');
        overlay.classList.add('is-visible');
        document.body.classList.add('menu-open');

        menuButton.setAttribute('aria-expanded', 'true');
        overlay.setAttribute('aria-hidden', 'false');

        closeButton.focus();
    }

    function closeSidebar(restoreFocus = true) {
        sidebar.classList.remove('is-open');
        overlay.classList.remove('is-visible');
        document.body.classList.remove('menu-open');

        menuButton.setAttribute('aria-expanded', 'false');
        overlay.setAttribute('aria-hidden', 'true');

        if (restoreFocus && isMobile()) {
            menuButton.focus();
        }
    }

    menuButton.addEventListener('click', openSidebar);
    closeButton.addEventListener('click', () => closeSidebar());
    overlay.addEventListener('click', () => closeSidebar());

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && sidebar.classList.contains('is-open')) {
            closeSidebar();
        }
    });

    sidebar.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', () => {
            if (isMobile()) closeSidebar(false);
        });
    });

    window.addEventListener('resize', () => {
        if (!isMobile()) closeSidebar(false);
    });
})();
</script>

</body>
</html>
```
