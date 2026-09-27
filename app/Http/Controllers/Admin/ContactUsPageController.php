<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\StoresAdminUploads;
use App\Http\Controllers\Controller;
use App\Models\ContactUsSetting;
use App\Models\ContactUsSocialCard;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactUsPageController extends Controller
{
    use StoresAdminUploads;

    public function editSettings(): View
    {
        $page = Page::query()->where('slug', 'contact-us')->firstOrFail();

        return view('admin.pages.contact-us.settings', [
            'page' => $page,
            'settings' => ContactUsSetting::current(),
            'breadcrumbs' => $page->breadcrumb(),
        ]);
    }

    public function updateSettings(Request $request): RedirectResponse
    {
        $settings = ContactUsSetting::current();

        $validated = $request->validate([
            'banner_label' => ['nullable', 'string', 'max:255'],
            'banner_title' => ['nullable', 'string', 'max:255'],
            'submit_button_text' => ['nullable', 'string', 'max:100'],
            'placeholder_first_name' => ['nullable', 'string', 'max:150'],
            'placeholder_last_name' => ['nullable', 'string', 'max:150'],
            'placeholder_email' => ['nullable', 'string', 'max:150'],
            'placeholder_phone' => ['nullable', 'string', 'max:150'],
            'placeholder_job_title' => ['nullable', 'string', 'max:150'],
            'placeholder_institution' => ['nullable', 'string', 'max:150'],
            'placeholder_message' => ['nullable', 'string', 'max:150'],
            'social_section_title' => ['nullable', 'string', 'max:255'],
        ]);

        $settings->update($validated);

        return redirect()
            ->route('admin.pages.contact-us.settings.edit')
            ->with('status', 'Contact Us page settings updated successfully.');
    }

    public function socialCardsIndex(): View
    {
        $page = Page::query()->where('slug', 'contact-us')->firstOrFail();

        return view('admin.pages.contact-us.social-cards.index', [
            'page' => $page,
            'cards' => ContactUsSocialCard::query()->orderBy('sort_order')->orderBy('id')->get(),
            'breadcrumbs' => $page->breadcrumb(),
        ]);
    }

    public function createSocialCard(): View
    {
        $page = Page::query()->where('slug', 'contact-us')->firstOrFail();

        return view('admin.pages.contact-us.social-cards.form', [
            'page' => $page,
            'card' => new ContactUsSocialCard([
                'sort_order' => (int) ContactUsSocialCard::query()->max('sort_order') + 1,
                'is_active' => true,
            ]),
            'breadcrumbs' => $page->breadcrumb(),
        ]);
    }

    public function storeSocialCard(Request $request): RedirectResponse
    {
        $validated = $this->validatedSocialCardPayload($request, null);
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['sort_order'] = $validated['sort_order']
            ?? ((int) ContactUsSocialCard::query()->max('sort_order') + 1);

        ContactUsSocialCard::query()->create($validated);

        return redirect()
            ->route('admin.pages.contact-us.social-cards.index')
            ->with('status', 'Social card created successfully.');
    }

    public function editSocialCard(ContactUsSocialCard $socialCard): View
    {
        $page = Page::query()->where('slug', 'contact-us')->firstOrFail();

        return view('admin.pages.contact-us.social-cards.form', [
            'page' => $page,
            'card' => $socialCard,
            'breadcrumbs' => $page->breadcrumb(),
        ]);
    }

    public function updateSocialCard(Request $request, ContactUsSocialCard $socialCard): RedirectResponse
    {
        $socialCard->update($this->validatedSocialCardPayload($request, $socialCard->image));

        return redirect()
            ->route('admin.pages.contact-us.social-cards.index')
            ->with('status', 'Social card updated successfully.');
    }

    public function destroySocialCard(ContactUsSocialCard $socialCard): RedirectResponse
    {
        $this->deleteAdminUpload($socialCard->image);
        $socialCard->delete();

        return redirect()
            ->route('admin.pages.contact-us.social-cards.index')
            ->with('status', 'Social card deleted successfully.');
    }

    private function validatedSocialCardPayload(Request $request, ?string $existingImage): array
    {
        $validated = $request->validate([
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'title' => ['nullable', 'string', 'max:255'],
            'url' => ['nullable', 'string', 'max:500'],
            'image' => ['nullable', 'image', 'max:5120'],
            'remove_image' => ['nullable', 'boolean'],
        ]);

        unset($validated['image'], $validated['remove_image']);

        $validated['image'] = $this->resolveSocialCardImage($request, $existingImage);
        $validated['is_active'] = $request->boolean('is_active');

        return $validated;
    }

    private function resolveSocialCardImage(Request $request, ?string $existing): ?string
    {
        if ($request->boolean('remove_image')) {
            $this->deleteAdminUpload($existing);

            return null;
        }

        if ($request->hasFile('image')) {
            $this->deleteAdminUpload($existing);

            return $this->storeAdminUpload($request->file('image'), 'contact-us/social-cards', 'icon');
        }

        return $existing;
    }
}
