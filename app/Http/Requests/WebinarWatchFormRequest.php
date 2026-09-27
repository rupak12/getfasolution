<?php

namespace App\Http\Requests;

use App\Http\Controllers\WebinarController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WebinarWatchFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $slugs = array_column(WebinarController::items(), 'slug');

        return [
            'webinar_slug' => ['required', 'string', Rule::in($slugs)],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email:rfc', 'max:255'],
        ];
    }
}
