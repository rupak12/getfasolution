@php
    $inputId = str_replace(['[', ']'], ['_', ''], $inputName);
    $fileInputName = $inputName;
    $removeInputName = preg_replace('/\]$/', '_remove]', $inputName);
    $hasImage = ! empty($value);
@endphp

<div class="admin-image-upload">
    @if ($hasImage)
        <div class="admin-image-preview-card">
            <img src="{{ page_image($value) }}" alt="Current uploaded image">
            <span class="admin-image-badge">Current image</span>
        </div>
    @else
        <div class="admin-image-placeholder">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                <rect x="3" y="5" width="18" height="14" rx="2" />
                <circle cx="8.5" cy="10.5" r="1.5" />
                <path d="M21 16l-5.5-5.5a2 2 0 0 0-2.8 0L3 18" />
            </svg>
            <span>No image uploaded yet</span>
        </div>
    @endif

    <div class="admin-image-actions">
        <label for="{{ $inputId }}_file" class="admin-btn admin-btn-secondary admin-file-label">
            {{ $hasImage ? 'Replace Image' : 'Upload Image' }}
            <input type="file" id="{{ $inputId }}_file" name="{{ $fileInputName }}" accept="image/*" class="admin-file-input">
        </label>

        @if ($hasImage)
            <label class="admin-checkbox admin-remove-image">
                <input type="checkbox" name="{{ $removeInputName }}" value="1">
                Remove image
            </label>
        @endif
    </div>

    <small class="admin-help">PNG, JPG, WEBP or SVG. Max 2MB recommended.</small>
</div>
