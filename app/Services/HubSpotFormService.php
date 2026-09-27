<?php

namespace App\Services;

use App\Models\HubspotSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class HubSpotFormService
{
    public function submitContact(array $data, Request $request): bool
    {
        $settings = HubspotSetting::current();

        if (! $settings->isReadyForContact()) {
            return true;
        }

        if (empty($data['email']) && empty($data['phone'])) {
            Log::warning('HubSpot contact sync skipped: no email or phone provided');

            return true;
        }

        return $this->submit(
            $settings,
            (string) $settings->contact_form_guid,
            config('hubspot.contact_field_map', []),
            $data,
            $request,
            'Website contact form'
        );
    }

    public function submitNewsletter(array $data, Request $request): bool
    {
        $settings = HubspotSetting::current();

        if (! $settings->isReadyForNewsletter()) {
            return true;
        }

        $formGuid = $settings->newsletterFormGuid();

        if ($formGuid === null) {
            return true;
        }

        return $this->submit(
            $settings,
            $formGuid,
            config('hubspot.newsletter_field_map', []),
            $data,
            $request,
            'Website newsletter signup'
        );
    }

    public function verifyConnection(HubspotSetting $settings, ?string $plainToken = null): array
    {
        $token = $plainToken ?? $settings->accessTokenForApi();

        if ($token === null || $token === '') {
            return ['ok' => false, 'message' => 'Private app access token is required.'];
        }

        if (! filled($settings->portal_id)) {
            return ['ok' => false, 'message' => 'Portal ID is required.'];
        }

        try {
            $response = Http::timeout(15)
                ->withToken($token)
                ->acceptJson()
                ->get('https://api.hubapi.com/account-info/v3/details');

            if (! $response->successful()) {
                return [
                    'ok' => false,
                    'message' => 'HubSpot rejected the access token. Check the token and app scopes (forms).',
                ];
            }

            $remotePortalId = (string) ($response->json('portalId') ?? '');

            if ($remotePortalId !== '' && $remotePortalId !== (string) $settings->portal_id) {
                return [
                    'ok' => false,
                    'message' => "Portal ID mismatch. HubSpot account portal is {$remotePortalId}.",
                ];
            }

            return ['ok' => true, 'message' => 'Connection verified successfully.'];
        } catch (\Throwable $exception) {
            Log::warning('HubSpot connection test failed', [
                'error' => $exception->getMessage(),
            ]);

            return ['ok' => false, 'message' => 'Could not reach HubSpot. Check your server network and token.'];
        }
    }

    private function submit(
        HubspotSetting $settings,
        string $formGuid,
        array $fieldMap,
        array $data,
        Request $request,
        string $pageName
    ): bool {
        $token = $settings->accessTokenForApi();

        if ($token === null) {
            return false;
        }

        $fields = [];

        foreach ($fieldMap as $localKey => $hubspotName) {
            $value = $data[$localKey] ?? null;

            if ($value === null || $value === '') {
                continue;
            }

            $fields[] = [
                'name' => $hubspotName,
                'value' => (string) $value,
            ];
        }

        if ($fields === []) {
            return true;
        }

        $payload = [
            'fields' => $fields,
            'context' => $this->submissionContext($request, $pageName),
        ];

        $url = sprintf(
            '%s/%s/%s',
            rtrim(config('hubspot.submit_url'), '/'),
            rawurlencode((string) $settings->portal_id),
            rawurlencode($formGuid)
        );

        try {
            $response = Http::timeout(20)
                ->withToken($token)
                ->acceptJson()
                ->asJson()
                ->post($url, $payload);

            if ($response->successful()) {
                return true;
            }

            Log::error('HubSpot form submission failed', [
                'status' => $response->status(),
                'form_guid' => Str::mask($formGuid, '*', 4),
                'body' => $response->json() ?? $response->body(),
            ]);

            return false;
        } catch (\Throwable $exception) {
            Log::error('HubSpot form submission exception', [
                'form_guid' => Str::mask($formGuid, '*', 4),
                'error' => $exception->getMessage(),
            ]);

            return false;
        }
    }

    private function submissionContext(Request $request, string $pageName): array
    {
        $context = [
            'pageName' => $pageName,
            'pageUri' => $request->headers->get('referer') ?? url()->previous() ?: url('/'),
        ];

        $hutk = $request->cookie('hubspotutk');

        if (is_string($hutk) && $hutk !== '') {
            $context['hutk'] = $hutk;
        }

        return $context;
    }
}
