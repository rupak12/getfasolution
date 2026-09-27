<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFooterBannerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'footer_cta_title' => ['required', 'string', 'max:200'],
            'footer_cta_text' => ['required', 'string', 'max:1000'],
            'footer_newsletter_title' => ['required', 'string', 'max:200'],
            'footer_newsletter_text' => ['required', 'string', 'max:2000'],
            'footer_newsletter_button_text' => ['required', 'string', 'max:50'],
        ];
    }
}
