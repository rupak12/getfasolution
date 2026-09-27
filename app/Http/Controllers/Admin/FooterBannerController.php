<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateFooterBannerRequest;
use App\Models\GlobalSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class FooterBannerController extends Controller
{
    public function edit(): View
    {
        return view('admin.footer-banner.edit', [
            'settings' => GlobalSetting::current(),
        ]);
    }

    public function update(UpdateFooterBannerRequest $request): RedirectResponse
    {
        $settings = GlobalSetting::query()->firstOrCreate([], GlobalSetting::defaults());
        $settings->fill($request->validated());
        $settings->save();
        GlobalSetting::refreshCache();

        return redirect()
            ->route('admin.footer-banner.edit')
            ->with('status', 'Footer banner updated successfully.');
    }
}
