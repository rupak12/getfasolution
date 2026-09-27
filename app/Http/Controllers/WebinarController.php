<?php

namespace App\Http\Controllers;

use App\Data\WebinarCatalog;
use Illuminate\View\View;

class WebinarController extends Controller
{
    /** @return list<array<string, mixed>> */
    public static function items(): array
    {
        return WebinarCatalog::items();
    }

    public static function find(string $slug): ?array
    {
        return WebinarCatalog::find($slug);
    }

    public function show(string $slug): View
    {
        $webinar = self::find($slug);

        abort_if($webinar === null, 404);

        return view('pages.webinar-show', [
            'webinar' => $webinar,
            'openRegisterModal' => request()->boolean('register'),
        ]);
    }
}
