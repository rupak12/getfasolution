<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateGlobalSettingsRequest;
use App\Models\GlobalSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GlobalSettingsController extends Controller
{
    public function edit(): View
    {
        return view('admin.settings.edit', [
            'settings' => GlobalSetting::current(),
        ]);
    }

    public function update(UpdateGlobalSettingsRequest $request): RedirectResponse
    {
        $settings = GlobalSetting::query()->firstOrCreate([], GlobalSetting::defaults());

        $data = $request->safe()->except([
            'header_logo',
            'footer_logo',
            'favicon',
        ]);

        $settings->fill($data);

        foreach (['header_logo', 'footer_logo', 'favicon'] as $field) {
            if ($request->hasFile($field)) {
                $this->deleteUploadedFile($settings->{$field});
                $settings->{$field} = $this->storeUploadedFile($request->file($field), $field);
            }
        }

        $settings->save();
        GlobalSetting::refreshCache();

        return redirect()
            ->route('admin.settings.edit')
            ->with('status', 'Global settings updated successfully.');
    }

    private function storeUploadedFile($file, string $prefix): string
    {
        $extension = $file->getClientOriginalExtension();
        $filename = $prefix.'-'.time().'.'.$extension;

        $path = $file->storeAs('settings', $filename, 'public');

        return 'storage/'.$path;
    }

    private function deleteUploadedFile(?string $path): void
    {
        if ($path === null || ! str_starts_with($path, 'storage/settings/')) {
            return;
        }

        $storagePath = str_replace('storage/', '', $path);
        Storage::disk('public')->delete($storagePath);
    }
}
