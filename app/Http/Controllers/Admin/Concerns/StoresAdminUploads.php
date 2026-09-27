<?php

namespace App\Http\Controllers\Admin\Concerns;

use Illuminate\Support\Facades\Storage;

trait StoresAdminUploads
{
    protected function storeAdminUpload($file, string $directory, string $fieldName): string
    {
        $extension = $file->getClientOriginalExtension() ?: 'bin';
        $safeName = preg_replace('/[^a-zA-Z0-9._-]+/', '-', $fieldName) ?? 'upload';
        $filename = trim($safeName, '-').'-'.time().'-'.uniqid().'.'.$extension;
        $path = $file->storeAs(trim($directory, '/'), $filename, 'public');

        return 'storage/'.$path;
    }

    protected function deleteAdminUpload(?string $path): void
    {
        if ($path === null || ! str_starts_with($path, 'storage/')) {
            return;
        }

        $storagePath = str_replace('storage/', '', $path);
        Storage::disk('public')->delete($storagePath);
    }
}
