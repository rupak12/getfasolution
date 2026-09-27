<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FooterBannerController;
use App\Http\Controllers\Admin\GlobalSettingsController;
use App\Http\Controllers\Admin\HubspotSettingsController;
use App\Http\Controllers\Admin\MenuSettingsController;
use App\Http\Controllers\Admin\ContactUsPageController;
use App\Http\Controllers\Admin\FaqPageController;
use App\Http\Controllers\Admin\OurServicesPageController;
use App\Http\Controllers\Admin\PagesSettingsController;
use App\Http\Controllers\Admin\SeoSettingsController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('admin.guest')->group(function () {
        Route::get('login', [LoginController::class, 'create'])->name('login');
        Route::post('login', [LoginController::class, 'store'])
            ->middleware('throttle:5,1')
            ->name('login.store');
    });

    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('settings', [GlobalSettingsController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [GlobalSettingsController::class, 'update'])->name('settings.update');
        Route::get('footer-banner', [FooterBannerController::class, 'edit'])->name('footer-banner.edit');
        Route::put('footer-banner', [FooterBannerController::class, 'update'])->name('footer-banner.update');
        Route::get('menu-settings', [MenuSettingsController::class, 'index'])->name('menu.index');
        Route::post('menu-settings', [MenuSettingsController::class, 'store'])->name('menu.store');
        Route::put('menu-settings/reorder', [MenuSettingsController::class, 'reorder'])->name('menu.reorder');
        Route::put('menu-settings/{menuItem}', [MenuSettingsController::class, 'update'])->name('menu.update');
        Route::delete('menu-settings/{menuItem}', [MenuSettingsController::class, 'destroy'])->name('menu.destroy');
        Route::get('seo-settings', [SeoSettingsController::class, 'index'])->name('seo.index');
        Route::get('seo-settings/{slug}', [SeoSettingsController::class, 'edit'])->name('seo.edit');
        Route::put('seo-settings/{slug}', [SeoSettingsController::class, 'update'])->name('seo.update');
        Route::get('hubspot-settings', [HubspotSettingsController::class, 'edit'])->name('hubspot.edit');
        Route::put('hubspot-settings', [HubspotSettingsController::class, 'update'])->name('hubspot.update');
        Route::get('pages-settings', [PagesSettingsController::class, 'index'])->name('pages.index');
        Route::get('pages-settings/contact-us/settings', [ContactUsPageController::class, 'editSettings'])->name('pages.contact-us.settings.edit');
        Route::put('pages-settings/contact-us/settings', [ContactUsPageController::class, 'updateSettings'])->name('pages.contact-us.settings.update');
        Route::get('pages-settings/contact-us/social-cards', [ContactUsPageController::class, 'socialCardsIndex'])->name('pages.contact-us.social-cards.index');
        Route::get('pages-settings/contact-us/social-cards/create', [ContactUsPageController::class, 'createSocialCard'])->name('pages.contact-us.social-cards.create');
        Route::post('pages-settings/contact-us/social-cards', [ContactUsPageController::class, 'storeSocialCard'])->name('pages.contact-us.social-cards.store');
        Route::get('pages-settings/contact-us/social-cards/{socialCard}/edit', [ContactUsPageController::class, 'editSocialCard'])->name('pages.contact-us.social-cards.edit');
        Route::put('pages-settings/contact-us/social-cards/{socialCard}', [ContactUsPageController::class, 'updateSocialCard'])->name('pages.contact-us.social-cards.update');
        Route::delete('pages-settings/contact-us/social-cards/{socialCard}', [ContactUsPageController::class, 'destroySocialCard'])->name('pages.contact-us.social-cards.destroy');
        Route::get('pages-settings/faq/settings', [FaqPageController::class, 'editSettings'])->name('pages.faq.settings.edit');
        Route::put('pages-settings/faq/settings', [FaqPageController::class, 'updateSettings'])->name('pages.faq.settings.update');
        Route::get('pages-settings/faq/items', [FaqPageController::class, 'itemsIndex'])->name('pages.faq.items.index');
        Route::get('pages-settings/faq/items/create', [FaqPageController::class, 'createItem'])->name('pages.faq.items.create');
        Route::post('pages-settings/faq/items', [FaqPageController::class, 'storeItem'])->name('pages.faq.items.store');
        Route::get('pages-settings/faq/items/{faqItem}/edit', [FaqPageController::class, 'editItem'])->name('pages.faq.items.edit');
        Route::put('pages-settings/faq/items/{faqItem}', [FaqPageController::class, 'updateItem'])->name('pages.faq.items.update');
        Route::delete('pages-settings/faq/items/{faqItem}', [FaqPageController::class, 'destroyItem'])->name('pages.faq.items.destroy');
        Route::get('pages-settings/our-services/settings', [OurServicesPageController::class, 'editSettings'])->name('pages.our-services.settings.edit');
        Route::put('pages-settings/our-services/settings', [OurServicesPageController::class, 'updateSettings'])->name('pages.our-services.settings.update');
        Route::get('pages-settings/our-services/cards', [OurServicesPageController::class, 'cardsIndex'])->name('pages.our-services.cards.index');
        Route::get('pages-settings/our-services/cards/create', [OurServicesPageController::class, 'createCard'])->name('pages.our-services.cards.create');
        Route::post('pages-settings/our-services/cards', [OurServicesPageController::class, 'storeCard'])->name('pages.our-services.cards.store');
        Route::get('pages-settings/our-services/cards/{ourServicesCard}/edit', [OurServicesPageController::class, 'editCard'])->name('pages.our-services.cards.edit');
        Route::put('pages-settings/our-services/cards/{ourServicesCard}', [OurServicesPageController::class, 'updateCard'])->name('pages.our-services.cards.update');
        Route::delete('pages-settings/our-services/cards/{ourServicesCard}', [OurServicesPageController::class, 'destroyCard'])->name('pages.our-services.cards.destroy');
        Route::get('pages-settings/our-services/why-items', [OurServicesPageController::class, 'whyItemsIndex'])->name('pages.our-services.why-items.index');
        Route::get('pages-settings/our-services/why-items/create', [OurServicesPageController::class, 'createWhyItem'])->name('pages.our-services.why-items.create');
        Route::post('pages-settings/our-services/why-items', [OurServicesPageController::class, 'storeWhyItem'])->name('pages.our-services.why-items.store');
        Route::get('pages-settings/our-services/why-items/{ourServicesWhyItem}/edit', [OurServicesPageController::class, 'editWhyItem'])->name('pages.our-services.why-items.edit');
        Route::put('pages-settings/our-services/why-items/{ourServicesWhyItem}', [OurServicesPageController::class, 'updateWhyItem'])->name('pages.our-services.why-items.update');
        Route::delete('pages-settings/our-services/why-items/{ourServicesWhyItem}', [OurServicesPageController::class, 'destroyWhyItem'])->name('pages.our-services.why-items.destroy');
        Route::get('pages-settings/{page}', [PagesSettingsController::class, 'show'])->name('pages.show');
        Route::get('pages-settings/{page}/sections/{section}', [PagesSettingsController::class, 'edit'])->name('pages.sections.edit');
        Route::put('pages-settings/{page}/sections/{section}', [PagesSettingsController::class, 'update'])->name('pages.sections.update');
        Route::post('logout', LogoutController::class)->name('logout');
    });
});
