<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class ResourceArticleController extends Controller
{
    public function show(): View
    {
        $slug = Route::currentRouteName();
        $article = config("resource_articles.articles.{$slug}");

        abort_unless(is_array($article), 404);

        return view('pages.articles.show', [
            'slug' => $slug,
            'article' => $article,
        ]);
    }
}
