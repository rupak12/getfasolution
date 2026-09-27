<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\InteractsWithNestedRequestInput;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\PageSection;
use App\Services\PageContentNormalizer;
use App\Services\PageContentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PagesSettingsController extends Controller
{
    use InteractsWithNestedRequestInput;
    public function index(): View
    {
        return view('admin.pages.index', [
            'pages' => Page::tree(),
        ]);
    }

    public function show(Page $page): View
    {
        $page->load('sections', 'parent');

        return match ($page->slug) {
            'contact-us' => view('admin.pages.contact-us.hub', [
                'page' => $page,
                'breadcrumbs' => $page->breadcrumb(),
            ]),
            'faq' => view('admin.pages.faq.hub', [
                'page' => $page,
                'breadcrumbs' => $page->breadcrumb(),
            ]),
            'our-services' => view('admin.pages.our-services.hub', [
                'page' => $page,
                'breadcrumbs' => $page->breadcrumb(),
            ]),
            default => view('admin.pages.show', [
                'page' => $page,
                'breadcrumbs' => $page->breadcrumb(),
            ]),
        };
    }

    public function edit(Page $page, PageSection $section): View
    {
        abort_if(in_array($page->slug, ['contact-us', 'faq', 'our-services'], true), 404);

        abort_unless($section->page_id === $page->id, 404);

        $section->load('page');

        $schema = $section->schema();

        abort_if($schema === null, 404);

        return view('admin.pages.edit', [
            'page' => $page->load('parent'),
            'section' => $section,
            'schema' => $schema,
            'content' => $this->sectionContent($section),
            'routes' => config('menu_routes', []),
            'breadcrumbs' => $page->breadcrumb(),
        ]);
    }

    public function update(Request $request, Page $page, PageSection $section, PageContentService $pageContent): RedirectResponse
    {
        abort_if(in_array($page->slug, ['contact-us', 'faq', 'our-services'], true), 404);

        abort_unless($section->page_id === $page->id, 404);

        $schema = $section->schema();

        abort_if($schema === null, 404);

        $fields = $schema['fields'] ?? [];
        $existing = $this->storedSectionContent($section, $schema);
        $content = $this->collectFieldValues($request, $fields, $existing, $page->slug, $section->key);

        if ($section->key === 'sessions' && isset($content['items']) && is_array($content['items'])) {
            $content['items'] = array_values(array_filter(
                $content['items'],
                fn ($row) => is_array($row) && trim((string) ($row['title'] ?? '')) !== ''
            ));
        }

        $content = app(PageContentNormalizer::class)->forStorage($content, $fields);

        $section->update(['content' => $content]);
        $section->refresh();
        $pageContent->refresh($page->slug);

        return redirect()
            ->route('admin.pages.sections.edit', [$page, $section])
            ->with('status', $section->label().' updated successfully.');
    }

    private function storedSectionContent(PageSection $section, ?array $schema = null): array
    {
        $schema ??= $section->schema() ?? [];
        $stored = $section->content ?? [];

        return app(PageContentNormalizer::class)->forAdmin(
            array_replace_recursive($schema['defaults'] ?? [], $stored),
            $schema['fields'] ?? []
        );
    }

    private function sectionContent(PageSection $section): array
    {
        $schema = $section->schema() ?? [];
        $stored = $section->content ?? [];

        if ($this->contentHasValues($stored) && ! $this->needsStructureReset($stored, $schema)) {
            return app(PageContentNormalizer::class)->forAdmin(
                array_replace_recursive($schema['defaults'] ?? [], $stored),
                $schema['fields'] ?? []
            );
        }

        $imported = app(\App\Services\PageContentImporter::class)->extractSection(
            $section->page->slug,
            $section->key,
            resource_path('views/pages/'.$section->page->slug.'.blade.php'),
            $section->schema() ?? []
        );

        if ($imported !== null && $imported !== []) {
            $section->update(['content' => $imported]);
            app(PageContentService::class)->refresh($section->page->slug);

            return app(PageContentNormalizer::class)->forAdmin(
                array_replace_recursive($schema['defaults'] ?? [], $imported),
                $schema['fields'] ?? []
            );
        }

        return app(PageContentNormalizer::class)->forAdmin(
            array_replace_recursive($schema['defaults'] ?? [], $stored),
            $schema['fields'] ?? []
        );
    }

    private function needsStructureReset(array $content, array $schema): bool
    {
        return app(\App\Services\PageContentImporter::class)->needsStructureReset($content, $schema);
    }

    private function contentHasValues(array $content): bool
    {
        foreach ($content as $value) {
            if (is_array($value) && $value !== []) {
                return true;
            }

            if (! is_array($value) && $value !== null && $value !== '') {
                return true;
            }
        }

        return false;
    }

    private function collectFieldValues(Request $request, array $fields, array $existing, string $pageSlug, string $sectionKey, string $prefix = 'content'): array
    {
        $content = [];

        foreach ($fields as $name => $field) {
            $inputName = "{$prefix}[{$name}]";

            if (($field['type'] ?? 'text') === 'repeater') {
                $existingRows = is_array($existing[$name] ?? null) ? $existing[$name] : [];
                $fromRequest = $request->input($this->nestedInputKey($inputName));
                $fromRequest = is_array($fromRequest) ? $fromRequest : [];

                $indices = array_values(array_filter(
                    array_keys($fromRequest),
                    fn ($key) => is_numeric($key)
                ));
                sort($indices, SORT_NUMERIC);

                $content[$name] = [];

                foreach ($indices as $position => $index) {
                    $index = (int) $index;
                    $rowExisting = $existingRows[$index] ?? ($existingRows[$position] ?? []);
                    $content[$name][] = $this->collectFieldValues(
                        $request,
                        $field['fields'] ?? [],
                        $rowExisting,
                        $pageSlug,
                        $sectionKey,
                        "{$inputName}[{$index}]"
                    );
                }

                continue;
            }

            if (($field['type'] ?? 'text') === 'image') {
                $removeKey = $this->nestedRemoveKey($inputName);

                if ($this->nestedBoolean($request, $removeKey)) {
                    $this->deleteUploadedFile($existing[$name] ?? null);
                    $content[$name] = null;

                    continue;
                }

                $uploaded = $this->nestedFile($request, $inputName);

                if ($uploaded !== null) {
                    $this->deleteUploadedFile($existing[$name] ?? null);
                    $content[$name] = $this->storeUploadedFile(
                        $uploaded,
                        $pageSlug,
                        $sectionKey,
                        $this->storageFieldKey($prefix, $name)
                    );

                    continue;
                }

                $content[$name] = $existing[$name] ?? null;

                continue;
            }

            $content[$name] = $this->nestedInput($request, $inputName, $existing[$name] ?? null);
        }

        return $content;
    }

    private function storeUploadedFile($file, string $pageSlug, string $sectionKey, string $fieldName): string
    {
        $extension = $file->getClientOriginalExtension() ?: 'bin';
        $safeName = preg_replace('/[^a-zA-Z0-9._-]+/', '-', $fieldName) ?? 'upload';
        $filename = trim($safeName, '-').'-'.time().'-'.uniqid().'.'.$extension;
        $path = $file->storeAs("pages/{$pageSlug}/{$sectionKey}", $filename, 'public');

        return 'storage/'.$path;
    }

    private function storageFieldKey(string $prefix, string $fieldName): string
    {
        $normalized = preg_replace('/[\[\]]+/', '-', $prefix) ?? $prefix;
        $normalized = trim($normalized, '-');

        return $normalized !== '' ? "{$normalized}-{$fieldName}" : $fieldName;
    }

    private function deleteUploadedFile(?string $path): void
    {
        if ($path === null || ! str_starts_with($path, 'storage/pages/')) {
            return;
        }

        $storagePath = str_replace('storage/', '', $path);
        Storage::disk('public')->delete($storagePath);
    }
}
