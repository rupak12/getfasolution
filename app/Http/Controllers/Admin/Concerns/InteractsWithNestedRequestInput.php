<?php

namespace App\Http\Controllers\Admin\Concerns;

use Illuminate\Http\Request;

trait InteractsWithNestedRequestInput
{
    protected function nestedInputKey(string $inputName): string
    {
        return str_replace(['[', ']'], ['.', ''], $inputName);
    }

    protected function nestedInput(Request $request, string $inputName, mixed $default = null): mixed
    {
        $dotKey = $this->nestedInputKey($inputName);

        if ($request->exists($dotKey)) {
            return $request->input($dotKey);
        }

        return $default;
    }

    protected function nestedBoolean(Request $request, string $inputName, bool $default = false): bool
    {
        $dotKey = $this->nestedInputKey($inputName);

        if (! $request->exists($dotKey)) {
            return $default;
        }

        return $request->boolean($dotKey);
    }

    protected function nestedFile(Request $request, string $inputName): mixed
    {
        $dotKey = $this->nestedInputKey($inputName);

        if ($request->hasFile($dotKey)) {
            return $request->file($dotKey);
        }

        if ($request->hasFile($inputName)) {
            return $request->file($inputName);
        }

        $file = data_get($request->allFiles(), $dotKey);

        return is_object($file) && method_exists($file, 'getClientOriginalExtension') ? $file : null;
    }

    protected function nestedRemoveKey(string $inputName): string
    {
        return preg_replace('/\]$/', '_remove]', $inputName) ?? $inputName.'_remove';
    }
}
