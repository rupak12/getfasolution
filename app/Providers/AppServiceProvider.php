<?php

namespace App\Providers;

use App\Models\GlobalSetting;
use App\Models\Page;
use App\Models\PageSection;
use App\Services\PageSeoService;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::bind('section', function (string $value, \Illuminate\Routing\Route $route) {
            $page = $route->parameter('page');

            if (! $page instanceof Page) {
                $page = Page::query()->where('slug', $page)->firstOrFail();
            }

            $query = PageSection::query()->where('page_id', $page->id);

            if (ctype_digit($value)) {
                return $query->where('id', (int) $value)->firstOrFail();
            }

            return $query->where('key', $value)->firstOrFail();
        });

        View::composer([
            'layouts.app',
            'layouts.header',
            'layouts.footer',
            'layouts.partials.header-menu',
            'pages.*',
        ], function ($view) {
            $view->with('settings', GlobalSetting::current());
        });

        View::composer('layouts.app', function ($view) {
            $view->with('seo', app(PageSeoService::class)->resolve(
                Route::currentRouteName(),
                $view->getData()
            ));
        });

        View::composer('layouts.partials.header-menu', function ($view) {
            $view->with('menuItems', \App\Models\MenuItem::headerTree());
        });
    }
}
