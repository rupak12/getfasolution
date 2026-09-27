<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqItem;
use App\Models\FaqSetting;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FaqPageController extends Controller
{
    public function editSettings(): View
    {
        $page = Page::query()->where('slug', 'faq')->firstOrFail();

        return view('admin.pages.faq.settings', [
            'page' => $page,
            'settings' => FaqSetting::current(),
            'routes' => config('menu_routes', []),
            'breadcrumbs' => $page->breadcrumb(),
        ]);
    }

    public function updateSettings(Request $request): RedirectResponse
    {
        $settings = FaqSetting::current();

        $validated = $request->validate([
            'banner_label' => ['nullable', 'string', 'max:255'],
            'banner_title' => ['nullable', 'string', 'max:255'],
            'intro_title' => ['nullable', 'string', 'max:500'],
            'intro_paragraph' => ['nullable', 'string', 'max:5000'],
            'intro_button_text' => ['nullable', 'string', 'max:255'],
            'intro_button_route' => ['nullable', 'string', 'max:100'],
        ]);

        $settings->update($validated);

        return redirect()
            ->route('admin.pages.faq.settings.edit')
            ->with('status', 'FAQ page settings updated successfully.');
    }

    public function itemsIndex(): View
    {
        $page = Page::query()->where('slug', 'faq')->firstOrFail();

        return view('admin.pages.faq.items.index', [
            'page' => $page,
            'items' => FaqItem::query()->orderBy('sort_order')->orderBy('id')->get(),
            'breadcrumbs' => $page->breadcrumb(),
        ]);
    }

    public function createItem(): View
    {
        $page = Page::query()->where('slug', 'faq')->firstOrFail();

        return view('admin.pages.faq.items.form', [
            'page' => $page,
            'item' => new FaqItem([
                'sort_order' => (int) FaqItem::query()->max('sort_order') + 1,
                'is_active' => true,
            ]),
            'breadcrumbs' => $page->breadcrumb(),
        ]);
    }

    public function storeItem(Request $request): RedirectResponse
    {
        $validated = $this->validateItem($request);
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['sort_order'] = $validated['sort_order']
            ?? ((int) FaqItem::query()->max('sort_order') + 1);

        FaqItem::query()->create($validated);

        return redirect()
            ->route('admin.pages.faq.items.index')
            ->with('status', 'FAQ item created successfully.');
    }

    public function editItem(FaqItem $faqItem): View
    {
        $page = Page::query()->where('slug', 'faq')->firstOrFail();

        return view('admin.pages.faq.items.form', [
            'page' => $page,
            'item' => $faqItem,
            'breadcrumbs' => $page->breadcrumb(),
        ]);
    }

    public function updateItem(Request $request, FaqItem $faqItem): RedirectResponse
    {
        $validated = $this->validateItem($request);
        $validated['is_active'] = $request->boolean('is_active');

        $faqItem->update($validated);

        return redirect()
            ->route('admin.pages.faq.items.index')
            ->with('status', 'FAQ item updated successfully.');
    }

    public function destroyItem(FaqItem $faqItem): RedirectResponse
    {
        $faqItem->delete();

        return redirect()
            ->route('admin.pages.faq.items.index')
            ->with('status', 'FAQ item deleted successfully.');
    }

    private function validateItem(Request $request): array
    {
        return $request->validate([
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'question' => ['required', 'string', 'max:500'],
            'answer' => ['nullable', 'string', 'max:20000'],
            'bullets' => ['nullable', 'string', 'max:20000'],
        ]);
    }
}
