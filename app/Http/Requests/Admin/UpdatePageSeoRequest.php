<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePageSeoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'meta_title' => ['required', 'string', 'max:200'],
            'meta_description' => ['required', 'string', 'max:500'],
            'meta_keywords' => ['nullable', 'string', 'max:500'],
            'meta_robots' => ['required', 'string', 'max:100'],
            'canonical_url' => ['nullable', 'url', 'max:500'],
            'og_title' => ['nullable', 'string', 'max:200'],
            'og_description' => ['nullable', 'string', 'max:500'],
            'og_image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'og_image_remove' => ['nullable', 'boolean'],
            'og_type' => ['required', 'string', 'max:50'],
            'twitter_card' => ['required', Rule::in(['summary', 'summary_large_image'])],
            'twitter_title' => ['nullable', 'string', 'max:200'],
            'twitter_description' => ['nullable', 'string', 'max:500'],
            'twitter_image' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'twitter_image_remove' => ['nullable', 'boolean'],
        ];
    }
}
