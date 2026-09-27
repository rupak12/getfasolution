<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateHubspotSettingsRequest;
use App\Models\HubspotSetting;
use App\Services\HubSpotFormService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HubspotSettingsController extends Controller
{
    public function edit(): View
    {
        $settings = HubspotSetting::current();

        return view('admin.hubspot.edit', [
            'settings' => $settings,
            'hasToken' => $settings->hasStoredAccessToken(),
        ]);
    }

    public function update(UpdateHubspotSettingsRequest $request, HubSpotFormService $hubSpot): RedirectResponse
    {
        $settings = HubspotSetting::current();
        $data = $request->validated();

        $plainToken = null;

        if (! empty($data['private_app_access_token'])) {
            $plainToken = $data['private_app_access_token'];
            $settings->private_app_access_token = $plainToken;
        }

        $settings->fill([
            'is_enabled' => (bool) ($data['is_enabled'] ?? false),
            'portal_id' => $data['portal_id'] ?? null,
            'contact_form_guid' => $data['contact_form_guid'] ?? null,
            'newsletter_form_guid' => $data['newsletter_form_guid'] ?? null,
        ]);

        $shouldVerify = $request->input('verify_connection') === '1'
            || $request->boolean('verify_connection');

        if ($shouldVerify) {
            $result = $hubSpot->verifyConnection($settings, $plainToken);

            if (! $result['ok']) {
                return back()
                    ->withInput($request->except('private_app_access_token'))
                    ->withErrors(['hubspot' => $result['message']]);
            }

            $settings->connection_verified_at = now();
        }

        $settings->save();

        $message = 'HubSpot settings saved successfully.';

        if ($shouldVerify) {
            $message = 'HubSpot settings saved and connection verified.';
        }

        return redirect()
            ->route('admin.hubspot.edit')
            ->with('status', $message);
    }
}
