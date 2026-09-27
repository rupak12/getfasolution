<?php

namespace App\Http\Requests\Admin;

use App\Models\HubspotSetting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateHubspotSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'is_enabled' => ['nullable', 'boolean'],
            'portal_id' => ['nullable', 'string', 'regex:/^\d+$/', 'max:20'],
            'contact_form_guid' => ['nullable', 'uuid'],
            'newsletter_form_guid' => ['nullable', 'uuid'],
            'private_app_access_token' => ['nullable', 'string', 'max:500'],
            'verify_connection' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'portal_id.regex' => 'Portal ID must be numeric (HubSpot Hub ID, e.g. 50596748).',
            'contact_form_guid.uuid' => 'Contact form GUID must be a valid UUID from HubSpot Forms.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_enabled' => $this->boolean('is_enabled'),
            'verify_connection' => $this->boolean('verify_connection'),
            'portal_id' => $this->filled('portal_id') ? trim((string) $this->input('portal_id')) : null,
            'contact_form_guid' => $this->filled('contact_form_guid') ? strtolower(trim((string) $this->input('contact_form_guid'))) : null,
            'newsletter_form_guid' => $this->filled('newsletter_form_guid') ? strtolower(trim((string) $this->input('newsletter_form_guid'))) : null,
        ]);
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            if (! $this->boolean('is_enabled')) {
                return;
            }

            if (! $this->filled('portal_id')) {
                $validator->errors()->add('portal_id', 'Portal ID is required when HubSpot sync is enabled.');
            }

            if (! $this->filled('contact_form_guid')) {
                $validator->errors()->add('contact_form_guid', 'Contact form GUID is required when HubSpot sync is enabled.');
            }

            $hasToken = $this->filled('private_app_access_token') || HubspotSetting::current()->hasStoredAccessToken();

            if (! $hasToken) {
                $validator->errors()->add('private_app_access_token', 'Access token is required when HubSpot sync is enabled.');
            }
        });
    }
}
