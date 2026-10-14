<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Market;
use App\Models\Project;
use App\Models\Service;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::query()->with(['author', 'category']);

        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('client_name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        $projects = $query->latest()
            ->paginate(10)
            ->withQueryString();

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $services = Service::orderBy('name')->get();
        $relatedProjects = Project::orderBy('title')->get();
        $authors = User::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        $markets = Market::orderBy('name')->get();

        return view('projects.create', compact(
            'services',
            'relatedProjects',
            'authors',
            'categories',
            'tags',
            'markets'
        ));
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'title' => ['required', 'string', 'max:255'],
        'slug' => [
            'required',
            'string',
            'max:255',
            'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            'unique:projects,slug',
        ],
        'description' => ['nullable', 'string', 'max:5000'],
        'image' => ['nullable', 'string', 'max:255'],
        'image_file' => ['nullable', 'image', 'max:5120'],
        'client_name' => ['nullable', 'string', 'max:255'],
        'project_url' => ['nullable', 'url', 'max:255'],
        'status' => ['required', Rule::in(['draft', 'published'])],

        'author_id' => ['nullable', 'integer', 'exists:users,id'],
        'category_id' => ['nullable', 'integer', 'exists:categories,id'],

        'service_ids' => ['nullable', 'array'],
        'service_ids.*' => [
            'integer',
            'distinct',
            Rule::exists('services', 'id'),
        ],

        'related_project_ids' => ['nullable', 'array'],
        'related_project_ids.*' => [
            'integer',
            'distinct',
            Rule::exists('projects', 'id'),
        ],

        'tag_ids' => ['nullable', 'array'],
        'tag_ids.*' => [
            'integer',
            'distinct',
            Rule::exists('tags', 'id'),
        ],

        'market_ids' => ['nullable', 'array'],
        'market_ids.*' => [
            'integer',
            'distinct',
            Rule::exists('markets', 'id'),
        ],
    ]);

    $serviceIds = $validated['service_ids'] ?? [];
    $relatedProjectIds = $validated['related_project_ids'] ?? [];
    $tagIds = $validated['tag_ids'] ?? [];
    $marketIds = $validated['market_ids'] ?? [];

    unset(
        $validated['service_ids'],
        $validated['related_project_ids'],
        $validated['tag_ids'],
        $validated['market_ids'],
        $validated['image_file']
    );

    if ($request->hasFile('image_file')) {
        $validated['image'] = $request->file('image_file')
            ->store('projects', 'public');
    }

    $project = Project::create($validated);

    $project->services()->sync($serviceIds);
    $project->relatedProjects()->sync($relatedProjectIds);
    $project->tags()->sync($tagIds);
    $project->markets()->sync($marketIds);

    return redirect()
        ->route('projects.index')
        ->with('success', 'Project created successfully.');
}
    public function show(Project $project)
    {
        $project->load([
            'author',
            'category',
            'services',
            'relatedProjects',
            'tags',
            'markets',
        ]);

        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $project->load([
            'author',
            'category',
            'services',
            'relatedProjects',
            'tags',
            'markets',
        ]);

        $services = Service::orderBy('name')->get();

        $relatedProjects = Project::where('id', '!=', $project->id)
            ->orderBy('title')
            ->get();

        $authors = User::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        $markets = Market::orderBy('name')->get();

        return view('projects.edit', compact(
            'project',
            'services',
            'relatedProjects',
            'authors',
            'categories',
            'tags',
            'markets'
        ));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('projects', 'slug')->ignore($project->id),
            ],
            'description' => ['nullable', 'string', 'max:5000'],
            'image' => ['nullable', 'string', 'max:255'],
'image_file' => ['nullable', 'image', 'max:5120'],
            'client_name' => ['nullable', 'string', 'max:255'],
            'project_url' => ['nullable', 'url', 'max:255'],
            'status' => ['required', Rule::in(['draft', 'published'])],

            'author_id' => ['nullable', 'integer', 'exists:users,id'],
            'category_id' => ['nullable', 'integer', 'exists:categories,id'],

            'service_ids' => ['nullable', 'array'],
            'service_ids.*' => [
                'integer',
                'distinct',
                Rule::exists('services', 'id'),
            ],

            'related_project_ids' => ['nullable', 'array'],
            'related_project_ids.*' => [
                'integer',
                'distinct',
                Rule::exists('projects', 'id')
                    ->whereNot('id', $project->id),
            ],

            'tag_ids' => ['nullable', 'array'],
            'tag_ids.*' => [
                'integer',
                'distinct',
                Rule::exists('tags', 'id'),
            ],

            'market_ids' => ['nullable', 'array'],
            'market_ids.*' => [
                'integer',
                'distinct',
                Rule::exists('markets', 'id'),
            ],
        ]);

        $serviceIds = $validated['service_ids'] ?? [];
        $relatedProjectIds = $validated['related_project_ids'] ?? [];
        $tagIds = $validated['tag_ids'] ?? [];
        $marketIds = $validated['market_ids'] ?? [];

        unset(
    $validated['service_ids'],
    $validated['related_project_ids'],
    $validated['tag_ids'],
    $validated['market_ids'],
    $validated['image_file']
);

if ($request->hasFile('image_file')) {
    $oldImage = $project->image;

    // Store the new image first.
    $newImage = $request->file('image_file')
        ->store('projects', 'public');

    if ($newImage === false) {
        return back()
            ->withInput()
            ->withErrors([
                'image_file' => 'The image could not be saved. Please try again.',
            ]);
    }

    $validated['image'] = $newImage;
}


elseif (!$request->filled('image')) {
    unset($validated['image']);
}


$project->update($validated);

// Delete the previous local image only after the project is updated.
if (
    isset($oldImage) &&
    $request->hasFile('image_file') &&
    $oldImage &&
    !str_starts_with($oldImage, 'http://') &&
    !str_starts_with($oldImage, 'https://') &&
    !str_starts_with($oldImage, 'data:image/')
) {
    Storage::disk('public')->delete($oldImage);
}

$project->services()->sync($serviceIds);
$project->relatedProjects()->sync($relatedProjectIds);
$project->tags()->sync($tagIds);
$project->markets()->sync($marketIds);

return redirect()
    ->route('projects.index')
    ->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project deleted successfully.');
    }
}
