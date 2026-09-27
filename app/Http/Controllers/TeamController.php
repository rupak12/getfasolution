<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TeamController extends Controller
{
    public function show(Request $request, ?string $slug = null): View|RedirectResponse
    {
        $members = collect(config('team.members', []))->keyBy('slug');

        if ($slug === null && $request->filled('member')) {
            return redirect()->route('team.member', $request->query('member'), 301);
        }

        $slug = $slug ?? $members->keys()->first();
        $member = $members->get($slug);

        abort_unless($member !== null, 404);

        return view('pages.team-member', [
            'member' => $member,
        ]);
    }
}
