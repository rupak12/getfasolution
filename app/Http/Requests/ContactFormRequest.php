<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => ['nullable', 'string', 'max:100'],
            'last_name' => ['nullable', 'string', 'max:100'],
            'email' => ['nullable', 'email:rfc,dns', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'job_title' => ['nullable', 'string', 'max:150'],
            'institution' => ['nullable', 'string', 'max:200'],
            'message' => ['nullable', 'string', 'max:5000'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'first_name' => $this->sanitize($this->input('first_name')),
            'last_name' => $this->sanitize($this->input('last_name')),
            'email' => $this->sanitize($this->input('email')),
            'phone' => $this->sanitize($this->input('phone')),
            'job_title' => $this->sanitize($this->input('job_title')),
            'institution' => $this->sanitize($this->input('institution')),
            'message' => $this->sanitize($this->input('message')),
        ]);
    }

    private function sanitize(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        return trim(strip_tags($value));
    }
}
