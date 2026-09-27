<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\StoresAdminUploads;
use App\Http\Controllers\Controller;
use App\Models\OurServicesCard;
use App\Models\OurServicesSetting;
use App\Models\OurServicesWhyItem;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OurServicesPageController extends Controller
{
    use StoresAdminUploads;

    public function editSettings(): View
    {
        $page = Page::query()->where('slug', 'our-services')->firstOrFail();

        return view('admin.pages.our-services.settings', [
            'page' => $page,
            'settings' => OurServicesSetting::current(),
            'routes' => config('menu_routes', []),
            'breadcrumbs' => $page->breadcrumb(),
        ]);
    }

    public function updateSettings(Request $request): RedirectResponse
    {
        $settings = OurServicesSetting::current();

        $settings->update($request->validate([
            'banner_label' => ['nullable', 'string', 'max:255'],
            'banner_title' => ['nullable', 'string', 'max:255'],
            'core_section_title' => ['nullable', 'string', 'max:255'],
            'core_section_intro' => ['nullable', 'string', 'max:5000'],
            'why_section_title' => ['nullable', 'string', 'max:255'],
            'why_cta_button_text' => ['nullable', 'string', 'max:255'],
            'why_cta_button_route' => ['nullable', 'string', 'max:100'],
        ]));

        return redirect()
            ->route('admin.pages.our-services.settings.edit')
            ->with('status', 'Our Services page settings updated successfully.');
    }

    public function cardsIndex(): View
    {
        $page = Page::query()->where('slug', 'our-services')->firstOrFail();

        return view('admin.pages.our-services.cards.index', [
            'page' => $page,
            'cards' => OurServicesCard::query()->orderBy('sort_order')->orderBy('id')->get(),
            'breadcrumbs' => $page->breadcrumb(),
        ]);
    }

    public function createCard(): View
    {
        $page = Page::query()->where('slug', 'our-services')->firstOrFail();

        return view('admin.pages.our-services.cards.form', [
            'page' => $page,
            'card' => new OurServicesCard([
                'sort_order' => (int) OurServicesCard::query()->max('sort_order') + 1,
                'is_active' => true,
            ]),
            'routes' => config('menu_routes', []),
            'breadcrumbs' => $page->breadcrumb(),
        ]);
    }

    public function storeCard(Request $request): RedirectResponse
    {
        $payload = $this->validatedCardPayload($request, null);
        $payload['is_active'] = $request->boolean('is_active', true);
        $payload['sort_order'] = $payload['sort_order']
            ?? ((int) OurServicesCard::query()->max('sort_order') + 1);

        OurServicesCard::query()->create($payload);

        return redirect()
            ->route('admin.pages.our-services.cards.index')
            ->with('status', 'Service card created successfully.');
    }

    public function editCard(OurServicesCard $ourServicesCard): View
    {
        $page = Page::query()->where('slug', 'our-services')->firstOrFail();

        return view('admin.pages.our-services.cards.form', [
            'page' => $page,
            'card' => $ourServicesCard,
            'routes' => config('menu_routes', []),
            'breadcrumbs' => $page->breadcrumb(),
        ]);
    }

    public function updateCard(Request $request, OurServicesCard $ourServicesCard): RedirectResponse
    {
        $ourServicesCard->update($this->validatedCardPayload($request, $ourServicesCard->image));

        return redirect()
            ->route('admin.pages.our-services.cards.index')
            ->with('status', 'Service card updated successfully.');
    }

    public function destroyCard(OurServicesCard $ourServicesCard): RedirectResponse
    {
        $this->deleteAdminUpload($ourServicesCard->image);
        $ourServicesCard->delete();

        return redirect()
            ->route('admin.pages.our-services.cards.index')
            ->with('status', 'Service card deleted successfully.');
    }

    public function whyItemsIndex(): View
    {
        $page = Page::query()->where('slug', 'our-services')->firstOrFail();

        return view('admin.pages.our-services.why-items.index', [
            'page' => $page,
            'items' => OurServicesWhyItem::query()->orderBy('sort_order')->orderBy('id')->get(),
            'breadcrumbs' => $page->breadcrumb(),
        ]);
    }

    public function createWhyItem(): View
    {
        $page = Page::query()->where('slug', 'our-services')->firstOrFail();

        return view('admin.pages.our-services.why-items.form', [
            'page' => $page,
            'item' => new OurServicesWhyItem([
                'sort_order' => (int) OurServicesWhyItem::query()->max('sort_order') + 1,
                'is_active' => true,
            ]),
            'breadcrumbs' => $page->breadcrumb(),
        ]);
    }

    public function storeWhyItem(Request $request): RedirectResponse
    {
        $payload = $this->validatedWhyItemPayload($request, null);
        $payload['is_active'] = $request->boolean('is_active', true);
        $payload['sort_order'] = $payload['sort_order']
            ?? ((int) OurServicesWhyItem::query()->max('sort_order') + 1);

        OurServicesWhyItem::query()->create($payload);

        return redirect()
            ->route('admin.pages.our-services.why-items.index')
            ->with('status', 'Why item created successfully.');
    }

    public function editWhyItem(OurServicesWhyItem $ourServicesWhyItem): View
    {
        $page = Page::query()->where('slug', 'our-services')->firstOrFail();

        return view('admin.pages.our-services.why-items.form', [
            'page' => $page,
            'item' => $ourServicesWhyItem,
            'breadcrumbs' => $page->breadcrumb(),
        ]);
    }

    public function updateWhyItem(Request $request, OurServicesWhyItem $ourServicesWhyItem): RedirectResponse
    {
        $ourServicesWhyItem->update($this->validatedWhyItemPayload($request, $ourServicesWhyItem->icon));

        return redirect()
            ->route('admin.pages.our-services.why-items.index')
            ->with('status', 'Why item updated successfully.');
    }

    public function destroyWhyItem(OurServicesWhyItem $ourServicesWhyItem): RedirectResponse
    {
        $this->deleteAdminUpload($ourServicesWhyItem->icon);
        $ourServicesWhyItem->delete();

        return redirect()
            ->route('admin.pages.our-services.why-items.index')
            ->with('status', 'Why item deleted successfully.');
    }

    private function validatedCardPayload(Request $request, ?string $existingImage): array
    {
        $validated = $request->validate([
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image_alt' => ['nullable', 'string', 'max:255'],
            'title' => ['nullable', 'string', 'max:500'],
            'intro' => ['nullable', 'string', 'max:5000'],
            'bullets' => ['nullable', 'string', 'max:10000'],
            'button_text' => ['nullable', 'string', 'max:255'],
            'button_route' => ['nullable', 'string', 'max:100'],
            'image' => ['nullable', 'image', 'max:5120'],
            'remove_image' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        unset($validated['image'], $validated['remove_image']);

        if ($request->boolean('remove_image')) {
            $this->deleteAdminUpload($existingImage);
            $validated['image'] = null;
        } elseif ($request->hasFile('image')) {
            $this->deleteAdminUpload($existingImage);
            $validated['image'] = $this->storeAdminUpload($request->file('image'), 'our-services/cards', 'card-image');
        } else {
            $validated['image'] = $existingImage;
        }

        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }

    private function validatedWhyItemPayload(Request $request, ?string $existingIcon): array
    {
        $validated = $request->validate([
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'title' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string', 'max:5000'],
            'icon' => ['nullable', 'image', 'max:5120'],
            'remove_icon' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        unset($validated['icon'], $validated['remove_icon']);

        if ($request->boolean('remove_icon')) {
            $this->deleteAdminUpload($existingIcon);
            $validated['icon'] = null;
        } elseif ($request->hasFile('icon')) {
            $this->deleteAdminUpload($existingIcon);
            $validated['icon'] = $this->storeAdminUpload($request->file('icon'), 'our-services/why-items', 'icon');
        } else {
            $validated['icon'] = $existingIcon;
        }

        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }
}
