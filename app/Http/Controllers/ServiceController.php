<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceController extends Controller
{
    private function supportedLocales(): array
    {
        return config('locales.supported', [
            'en' => 'English',
            'ar' => 'العربية',
            'tr' => 'Türkçe',
        ]);
    }

    public function index(Request $request): View
    {
        $services = Service::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->input('search');

                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->input('status'));
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('services.index', compact('services'));
    }

    public function create(): View
    {
        return view('services.create', [
            'service' => new Service(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => [
                'required',
                Rule::in(['draft', 'published', 'archived']),
            ],
        ]);

        $data['slug'] = Str::slug($data['slug'] ?: $data['name']);

        if (Service::where('slug', $data['slug'])->exists()) {
            return back()->withInput()->withErrors([
                'slug' => 'This slug is already in use.',
            ]);
        }

        $service = DB::transaction(function () use ($data) {
            $service = Service::create($data);

            ServiceTranslation::create([
                'service_id' => $service->id,
                'locale' => 'en',
                'name' => $service->name,
                'slug' => $service->slug,
                'description' => $service->description,
                'status' => $service->status,
            ]);

            return $service;
        });

        return redirect()
            ->route('services.edit', $service)
            ->with('success', 'Service created successfully.');
    }

    public function edit(Service $service): View
    {
        $service->load('translations');

        $translations = $service->translations->keyBy('locale');
        $locales = $this->supportedLocales();

        return view('services.edit', compact(
            'service',
            'translations',
            'locales'
        ));
    }

    public function update(
        Request $request,
        Service $service
    ): RedirectResponse {
        $locales = $this->supportedLocales();

        $rules = [];

        foreach ($locales as $locale => $label) {
            $rules["translations.{$locale}.name"] = [
                $locale === 'en' ? 'required' : 'nullable',
                'string',
                'max:255',
            ];

            $rules["translations.{$locale}.slug"] = [
                'nullable',
                'string',
                'max:255',
            ];

            $rules["translations.{$locale}.description"] = [
                'nullable',
                'string',
            ];

            $rules["translations.{$locale}.status"] = [
                'nullable',
                Rule::in(['draft', 'published', 'archived']),
            ];

            $rules["translations.{$locale}.meta_title"] = [
                'nullable',
                'string',
                'max:255',
            ];

            $rules["translations.{$locale}.meta_description"] = [
                'nullable',
                'string',
                'max:1000',
            ];
        }

        $validated = $request->validate($rules);

        DB::transaction(function () use (
            $service,
            $validated,
            $locales
        ) {
            foreach ($locales as $locale => $label) {
                $input = $validated['translations'][$locale] ?? [];
                $name = trim($input['name'] ?? '');

                // لا ننشئ ترجمة فارغة للغة لم يبدأ المستخدم بتحريرها.
                if ($name === '' && $locale !== 'en') {
                    continue;
                }

                $translation = ServiceTranslation::query()
                    ->where('service_id', $service->id)
                    ->where('locale', $locale)
                    ->first();

                $slugInput = trim($input['slug'] ?? '');

                $slug = Str::slug(
                    $slugInput !== '' ? $slugInput : $name
                );

                if ($slug === '') {
                    $slug = $locale . '-' . $service->id;
                }

                $duplicate = ServiceTranslation::query()
                    ->where('locale', $locale)
                    ->where('slug', $slug)
                    ->when(
                        $translation,
                        fn ($query) => $query->where(
                            'id',
                            '!=',
                            $translation->id
                        )
                    )
                    ->exists();

                if ($duplicate) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        "translations.{$locale}.slug" =>
                            "This URL slug is already in use for {$label}.",
                    ]);
                }

                $values = [
                    'name' => $name,
                    'slug' => $slug,
                    'description' => $input['description'] ?? null,
                    'status' => $input['status']
                        ?? ($translation?->status ?? 'draft'),
                    'meta_title' => $input['meta_title'] ?? null,
                    'meta_description' =>
                        $input['meta_description'] ?? null,
                ];

                if ($translation) {
                    $translation->update($values);
                } else {
                    ServiceTranslation::create(array_merge(
                        $values,
                        [
                            'service_id' => $service->id,
                            'locale' => $locale,
                        ]
                    ));
                }
            }

            // Keep the legacy service fields aligned with English.
            $english = ServiceTranslation::query()
                ->where('service_id', $service->id)
                ->where('locale', 'en')
                ->firstOrFail();

            $service->update([
                'name' => $english->name,
                'slug' => $english->slug,
                'description' => $english->description,
                'status' => $english->status,
            ]);
        });

        return redirect()
            ->route('services.edit', $service)
            ->with('success', 'Service translations saved successfully.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->update(['status' => 'archived']);

        $service->translations()
            ->where('locale', 'en')
            ->update(['status' => 'archived']);

        return redirect()
            ->route('services.index')
            ->with('success', 'Service archived successfully.');
    }
}
