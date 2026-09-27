<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGlobalSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'site_name' => ['required', 'string', 'max:150'],
            'header_logo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'footer_logo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'favicon' => ['nullable', 'file', 'mimes:png,ico,jpg,jpeg,webp', 'max:1024'],
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'youtube_url' => ['nullable', 'url', 'max:255'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'contact_phone' => ['required', 'string', 'max:30'],
            'contact_email' => ['required', 'email:rfc', 'max:255'],
            'contact_address' => ['required', 'string', 'max:500'],
            'contact_website' => ['nullable', 'string', 'max:255'],
            'footer_about' => ['required', 'string', 'max:2000'],
            'copyright_text' => ['required', 'string', 'max:1000'],
        ];
    }
}
