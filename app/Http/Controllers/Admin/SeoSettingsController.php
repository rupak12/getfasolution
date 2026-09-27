<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdatePageSeoRequest;
use App\Models\PageSeo;
use App\Services\PageSeoService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SeoSettingsController extends Controller
{
    public function index(PageSeoService $pageSeo): View
    {
        $entries = collect(config('page_seo.entries', []))->map(function (array $entry) use ($pageSeo) {
            $resolved = $pageSeo->resolveForAdmin($entry['slug']);

            return [
                'slug' => $entry['slug'],
                'label' => $entry['label'],
                'route' => $entry['route'],
                'meta_title' => $resolved['resolved']['meta_title'],
                'meta_description' => $resolved['resolved']['meta_description'],
                'has_custom' => $resolved['stored'] !== null,
            ];
        });

        return view('admin.seo.index', [
            'entries' => $entries,
        ]);
    }

    public function edit(string $slug, PageSeoService $pageSeo): View
    {
        $data = $pageSeo->resolveForAdmin($slug);

        return view('admin.seo.edit', [
            'slug' => $slug,
            'entry' => $data['entry'],
            'values' => $data['values'],
            'resolved' => $data['resolved'],
            'stored' => $data['stored'],
        ]);
    }

    public function update(UpdatePageSeoRequest $request, string $slug, PageSeoService $pageSeo): RedirectResponse
    {
        $entry = $pageSeo->entryForSlug($slug);
        abort_if($entry === null, 404);

        $routeKey = $entry['route'];
        $record = PageSeo::query()->firstOrNew(['route_key' => $routeKey]);
        $existing = $record->exists ? $record->toArray() : [];

        $data = $request->safe()->except([
            'og_image',
            'og_image_remove',
            'twitter_image',
            'twitter_image_remove',
        ]);

        $record->fill($data);

        $record->og_image = $this->handleImageUpload(
            $request,
            'og_image',
            'og_image_remove',
            $existing['og_image'] ?? null,
            $routeKey,
            'og'
        );

        $record->twitter_image = $this->handleImageUpload(
            $request,
            'twitter_image',
            'twitter_image_remove',
            $existing['twitter_image'] ?? null,
            $routeKey,
            'twitter'
        );

        $record->save();
        $pageSeo->refresh($routeKey);

        return redirect()
            ->route('admin.seo.edit', $slug)
            ->with('status', $entry['label'].' SEO updated successfully.');
    }

    private function handleImageUpload($request, string $field, string $removeField, ?string $existing, string $routeKey, string $prefix): ?string
    {
        if ($request->boolean($removeField)) {
            $this->deleteUploadedFile($existing);

            return null;
        }

        if ($request->hasFile($field)) {
            $this->deleteUploadedFile($existing);

            return $this->storeUploadedFile($request->file($field), $routeKey, $prefix);
        }

        return $existing;
    }

    private function storeUploadedFile($file, string $routeKey, string $prefix): string
    {
        $extension = $file->getClientOriginalExtension();
        $filename = $prefix.'-'.time().'.'.$extension;
        $path = $file->storeAs('seo/'.$routeKey, $filename, 'public');

        return 'storage/'.$path;
    }

    private function deleteUploadedFile(?string $path): void
    {
        if ($path === null || ! str_starts_with($path, 'storage/seo/')) {
            return;
        }

        Storage::disk('public')->delete(str_replace('storage/', '', $path));
    }
}
