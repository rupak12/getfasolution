<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ResourceArticleController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\WebinarController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'show'])->defaults('page', 'home')->name('home');

$pageRoutes = [
    'who-we-are',
    'about-us',
    'our-services',
    'team',
    'our-partnership',
    'get-started',
    'contact-us',
    'financial-aid-processing',
    'financial-aid-staffing',
    'student-outreach-communication',
    'financial-aid-consulting',
    'testimonials',
    'case-studies',
    'faq',
    'blogs',
    'fed-updates',
    'knowledge-nuggets',
    'white-paper-report',
    'webinar',
    'financial-aid-regulatory-and-compliance-checklist',
    'careers',
];

foreach ($pageRoutes as $page) {
    Route::get('/'.$page, [PageController::class, 'show'])
        ->defaults('page', $page)
        ->name($page);
}

Route::get('/webinar--{slug}', function (string $slug) {
    if (WebinarController::find($slug) === null) {
        abort(404);
    }

    return redirect()->route('webinar', ['watch' => $slug]);
})->where('slug', '[a-z0-9\-]+')->name('webinar.show');

foreach (array_keys(config('resource_articles.articles', [])) as $articleSlug) {
    Route::get('/'.$articleSlug, [ResourceArticleController::class, 'show'])
        ->name($articleSlug);

    Route::get('/'.$articleSlug.'.html', fn () => redirect()->route($articleSlug, [], 301));
}

Route::get('/team-member/{slug?}', [TeamController::class, 'show'])->name('team.member');

Route::post('/newsletter', [FormController::class, 'newsletter'])
    ->middleware('throttle:10,1')
    ->name('forms.newsletter');

Route::post('/contact', [FormController::class, 'contact'])
    ->middleware('throttle:10,1')
    ->name('forms.contact');

Route::post('/webinar/watch', [FormController::class, 'webinarWatch'])
    ->middleware('throttle:10,1')
    ->name('forms.webinar.watch');

Route::get('/index.html', fn () => redirect()->route('home', [], 301));

foreach ($pageRoutes as $page) {
    Route::get('/'.$page.'.html', function () use ($page) {
        return redirect()->route($page, [], 301);
    });
}

Route::get('/team-member.html', fn () => redirect()->route('team.member', ['slug' => 'brenda-wright'], 301));
Route::get('/contact-us.html', fn () => redirect()->route('contact-us', [], 301));
