<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project | WebLabStudios</title>

    <style>
        :root {
            --black: #171815;
            --lime: #d7ff64;
            --paper: #f6f6f0;
            --white: #fff;
            --text: #20211e;
            --muted: #85877e;
            --border: #e4e5dc;
            --danger: #b42318;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: var(--text);
            background: var(--paper);
        }

        input, textarea, select, button { font: inherit; }

        a { color: inherit; text-decoration: none; }

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: 240px;
            padding: 28px 20px;
            color: white;
            background: var(--black);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 45px;
            font-size: 17px;
            font-weight: 800;
        }

        .brand-mark {
            display: grid;
            place-items: center;
            width: 42px;
            height: 42px;
            color: var(--black);
            background: var(--lime);
            border-radius: 12px;
            font-size: 22px;
        }

        .nav-label {
            margin: 0 10px 12px;
            color: #92948a;
            font-size: 10px;
            letter-spacing: 1.8px;
        }

        .nav-link {
            display: block;
            margin-bottom: 7px;
            padding: 13px;
            color: #c1c3b9;
            border-radius: 9px;
            font-size: 13px;
        }

        .nav-link.active {
            color: var(--lime);
            background: #303329;
        }

        .main { margin-left: 240px; }

        .topbar {
            padding: 25px 35px;
            background: white;
            border-bottom: 1px solid var(--border);
            font-size: 12px;
            color: var(--muted);
        }

        .content {
            max-width: 1200px;
            margin: auto;
            padding: 35px;
        }

        .heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .eyebrow {
            margin-bottom: 9px;
            color: var(--muted);
            font-size: 10px;
            font-weight: 800;
            letter-spacing: 2px;
        }

        h1 {
            margin: 0;
            font-size: 35px;
            letter-spacing: -1.5px;
        }

        .subtitle {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.7;
        }

        .panel {
            margin-bottom: 20px;
            padding: 25px;
            background: white;
            border: 1px solid var(--border);
            border-radius: 14px;
        }

        .panel-heading {
            margin-bottom: 22px;
            font-size: 17px;
            font-weight: 800;
        }

        .panel-kicker {
            margin-bottom: 7px;
            color: var(--muted);
            font-size: 10px;
            letter-spacing: 1.5px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .field { min-width: 0; }
        .full { grid-column: 1 / -1; }

        label {
            display: block;
            margin-bottom: 9px;
            font-size: 12px;
            font-weight: 750;
        }

        .input, .select, .textarea {
            display: block;
            width: 100%;
            min-width: 0;
            padding: 12px;
            color: var(--text);
            background: white;
            border: 1px solid #dedfd7;
            border-radius: 9px;
            outline: none;
            font-size: 12px;
        }

        .input, .select { min-height: 44px; }

        .textarea {
            min-height: 120px;
            resize: vertical;
            line-height: 1.7;
        }

        .input:focus, .select:focus, .textarea:focus {
            border-color: #a6c956;
            box-shadow: 0 0 0 3px rgba(215, 255, 100, .2);
        }

        .select[multiple] { min-height: 130px; }
        .help { color: var(--muted); font-size: 10px; line-height: 1.7; }
        .error { margin-top: 7px; color: var(--danger); font-size: 11px; }

        .notice {
            margin-bottom: 20px;
            padding: 14px;
            background: #fff2f0;
            border: 1px solid #efc3bf;
            border-radius: 9px;
            color: var(--danger);
            font-size: 12px;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 43px;
            padding: 0 18px;
            border: 1px solid var(--border);
            border-radius: 9px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 800;
        }

        .btn-secondary { background: white; }
        .btn-primary { background: var(--lime); border-color: var(--lime); }

        @media (max-width: 900px) {
            .sidebar { position: static; width: auto; padding: 18px; }
            .brand { margin-bottom: 20px; }
            .main { margin-left: 0; }
            .content { padding: 20px 15px; }
            .topbar { padding: 18px; }
        }

        @media (max-width: 560px) {
            .grid { grid-template-columns: 1fr; }
            .full { grid-column: auto; }
            .heading { align-items: flex-start; flex-direction: column; }
            h1 { font-size: 29px; }
            .panel { padding: 18px; }
            .actions { flex-wrap: wrap; }
        }
    </style>
</head>

<body>
    <aside class="sidebar">
        <a href="{{ route('dashboard') }}" class="brand">
            <span class="brand-mark">W</span>
            <span>WebLabStudios</span>
        </a>

        <div class="nav-label">WORKSPACE</div>

        <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
        <a href="{{ route('projects.index') }}" class="nav-link active">Projects</a>
        <a href="{{ route('projects.create') }}" class="nav-link">+ Create Project</a>
    </aside>

    <main class="main">
        <header class="topbar">
            Workspace / Projects / Edit
        </header>

        <div class="content">
            <div class="heading">
                <div>
                    <div class="eyebrow">PROJECT MANAGEMENT</div>
                    <h1>Edit project<span style="color:#a0bd55">.</span></h1>
                    <p class="subtitle">
                        Update your project information and its relationships.
                    </p>
                </div>

                <a class="btn btn-secondary" href="{{ route('projects.index') }}">
                    ← All projects
                </a>
            </div>

            @if ($errors->any())
                <div class="notice">
                    <strong>Please correct these errors:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form
                action="{{ route('projects.update', $project) }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
                @method('PUT')

                <section class="panel">
                    <div class="panel-heading">
                        <div class="panel-kicker">01 / CONTENT</div>
                        Project information
                    </div>

                    <div class="grid">
                        <div class="field full">
                            <label for="title">Project title *</label>
                            <input
                                class="input"
                                id="title"
                                name="title"
                                value="{{ old('title', $project->title) }}"
                                maxlength="255"
                                required
                            >
                            @error('title') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="field full">
                            <label for="slug">URL slug *</label>
                            <input
                                class="input"
                                id="slug"
                                name="slug"
                                value="{{ old('slug', $project->slug) }}"
                                pattern="[a-z0-9]+(-[a-z0-9]+)*"
                                maxlength="255"
                                required
                            >
                            <p class="help">Use lowercase English letters, numbers and hyphens.</p>
                            @error('slug') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="field">
                            <label for="client_name">Client name</label>
                            <input
                                class="input"
                                id="client_name"
                                name="client_name"
                                value="{{ old('client_name', $project->client_name) }}"
                                maxlength="255"
                            >
                            @error('client_name') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="field">
                            <label for="project_url">Project website</label>
                            <input
                                class="input"
                                type="url"
                                id="project_url"
                                name="project_url"
                                value="{{ old('project_url', $project->project_url) }}"
                                maxlength="255"
                                placeholder="https://example.com"
                            >
                            @error('project_url') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="field full">
    <label for="image">Cover image URL</label>

    <input
        class="input @error('image') is-invalid @enderror"
        type="text"
        id="image"
        name="image"
        value="{{ old('image', $project->image) }}"
        placeholder="https://example.com/images/project.jpg"
        maxlength="255"
    >

    @error('image')
        <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="field full">
    <label for="image_file">Upload a new cover image</label>

    <input
        class="input @error('image_file') is-invalid @enderror"
        type="file"
        id="image_file"
        name="image_file"
        accept="image/jpeg,image/png,image/webp"
    >

    <p class="help">
        JPG, PNG or WebP. Maximum size: 5 MB.
        Uploading a new file replaces the current image.
    </p>

    @error('image_file')
        <div class="error">{{ $message }}</div>
    @enderror

    @if ($project->image)
        <div style="margin-top: 12px;">
            <p class="help">Current cover image</p>
            @if (str_starts_with($project->image, 'http://') ||
                 str_starts_with($project->image, 'https://'))
                <img
                    src="{{ $project->image }}"
                    alt="Current cover image"
                    style="max-width: 240px; max-height: 160px; object-fit: cover; border-radius: 8px;"
                >
            @elseif (!str_starts_with($project->image, 'data:image/'))
                <img
                    src="{{ asset('storage/' . $project->image) }}"
                    alt="Current cover image"
                    style="max-width: 240px; max-height: 160px; object-fit: cover; border-radius: 8px;"
                >
            @endif
        </div>
    @endif
</div>

                        <div class="field full">
                            <label for="description">Project description</label>
                            <textarea
                                class="textarea"
                                id="description"
                                name="description"
                                maxlength="5000"
                            >{{ old('description', $project->description) }}</textarea>
                            @error('description') <div class="error">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </section>

                <section class="panel">
                    <div class="panel-heading">
                        <div class="panel-kicker">02 / RELATIONS</div>
                        Services and related content
                    </div>

                    <div class="grid">
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
                                        @selected(
                                            in_array(
                                                $service->id,
                                                old(
                                                    'service_ids',
                                                    $project->services->pluck('id')->all()
                                                )
                                            )
                                        )
                                    >
                                        {{ $service->name }}
                                    </option>
                                @endforeach
                            </select>

                            <p class="help">Mac: hold Command to select multiple services.</p>
                            @error('service_ids.*') <div class="error">{{ $message }}</div> @enderror
                        </div>

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
                                        @selected(
                                            in_array(
                                                $relatedProject->id,
                                                old(
                                                    'related_project_ids',
                                                    $project->relatedProjects->pluck('id')->all()
                                                )
                                            )
                                        )
                                    >
                                        {{ $relatedProject->title }}
                                    </option>
                                @endforeach
                            </select>

                            <p class="help">Select other projects related to this one.</p>
                            @error('related_project_ids.*') <div class="error">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </section>

                <section class="panel">
                    <div class="panel-heading">
                        <div class="panel-kicker">03 / PUBLISHING</div>
                        Project status
                    </div>

                    <div class="field">
                        <label for="status">Status *</label>

                        <select class="select" id="status" name="status" required>
                            <option
                                value="draft"
                                @selected(old('status', $project->status) === 'draft')
                            >
                                Draft
                            </option>

                            <option
                                value="published"
                                @selected(old('status', $project->status) === 'published')
                            >
                                Published
                            </option>
                        </select>

                        @error('status') <div class="error">{{ $message }}</div> @enderror
                    </div>
                </section>

                <section class="panel">
    <div class="panel-heading">
        <div class="panel-kicker">04 / RELATIONS</div>
        Author, Category, Tags and Markets
    </div>

    <div class="grid">

        <div class="field">
            <label for="author_id">Author</label>

            <select class="select" id="author_id" name="author_id">
                <option value="">Not assigned</option>

                @foreach ($authors as $author)
                    <option
                        value="{{ $author->id }}"
                        @selected((string) old('author_id', $project->author_id) === (string) $author->id)
                    >
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>

            @error('author_id')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label for="category_id">Category</label>

            <select class="select" id="category_id" name="category_id">
                <option value="">No category</option>

                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        @selected((string) old('category_id', $project->category_id) === (string) $category->id)
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            @error('category_id')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label for="tag_ids">Tags</label>

            <select class="select" id="tag_ids" name="tag_ids[]" multiple size="5">
                @foreach ($tags as $tag)
                    <option
                        value="{{ $tag->id }}"
                        @selected(in_array(
                            $tag->id,
                            array_map(
                                'intval',
                                old('tag_ids', $project->tags->pluck('id')->all())
                            )
                        ))
                    >
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>

            <p class="help">Hold Command on Mac to select multiple tags.</p>

            @error('tag_ids.*')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="field">
            <label for="market_ids">Markets</label>

            <select class="select" id="market_ids" name="market_ids[]" multiple size="5">
                @foreach ($markets as $market)
                    <option
                        value="{{ $market->id }}"
                        @selected(in_array(
                            $market->id,
                            array_map(
                                'intval',
                                old('market_ids', $project->markets->pluck('id')->all())
                            )
                        ))
                    >
                        {{ $market->name }}
                    </option>
                @endforeach
            </select>

            <p class="help">Hold Command on Mac to select multiple markets.</p>

            @error('market_ids.*')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

    </div>
</section>

                <div class="actions">
                    <a href="{{ route('projects.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>

                    <button type="submit" class="btn btn-primary">
                        Save changes ↗
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
