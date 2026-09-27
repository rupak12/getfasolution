@php
    $hasImage = ! empty($value);
    $imageUrl = $hasImage
        ? (str_starts_with($value, 'storage/') ? asset($value) : media_asset($value))
        : null;
@endphp

<div class="admin-image-upload">
    @if ($hasImage)
        <div class="admin-image-preview-card">
            <img src="{{ $imageUrl }}" alt="Current SEO image">
            <span class="admin-image-badge">Current image</span>
        </div>
    @else
        <div class="admin-image-placeholder">
            <span>No image set — social previews will use text only</span>
        </div>
    @endif

    <div class="admin-image-actions">
        <label for="{{ $inputName }}" class="admin-btn admin-btn-secondary admin-file-label">
            {{ $hasImage ? 'Replace Image' : 'Upload Image' }}
            <input type="file" id="{{ $inputName }}" name="{{ $inputName }}" accept="image/*" class="admin-file-input">
        </label>

        @if ($hasImage)
            <label class="admin-checkbox admin-remove-image">
                <input type="checkbox" name="{{ $removeName }}" value="1">
                Remove image
            </label>
        @endif
    </div>
</div>
