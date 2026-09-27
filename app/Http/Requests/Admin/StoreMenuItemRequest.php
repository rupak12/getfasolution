<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMenuItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:150'],
            'parent_id' => ['nullable', 'integer', 'exists:menu_items,id'],
            'route_name' => ['nullable', 'string', Rule::in(array_keys(config('menu_routes', [])))],
            'url_fragment' => ['nullable', 'string', 'max:100'],
            'custom_url' => ['nullable', 'string', 'max:255'],
            'is_active' => ['sometimes', 'boolean'],
        ];
    }
}
