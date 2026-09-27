@php
    $index = $index ?? 0;
    $row = is_array($row ?? null) ? $row : [];
    $prefix = "content[items][{$index}]";
    $cardTitle = trim((string) ($row['title'] ?? ''));
    $webinarNumber = is_numeric($index) ? ((int) $index + 1) : null;
    $displayTitle = $cardTitle !== ''
        ? $cardTitle
        : ($webinarNumber !== null ? 'Untitled webinar '.$webinarNumber : 'New webinar');
    $slugPreview = trim((string) ($row['slug'] ?? ''));
    $hasVideo = trim((string) ($row['video_url'] ?? '')) !== '';
    $thumbPath = $row['image'] ?? null;
@endphp

<div
    class="admin-repeater-item admin-webinar-item is-collapsed"
    data-index="{{ $index }}"
    data-search="{{ strtolower($displayTitle.' '.$slugPreview) }}"
>
    <div class="admin-webinar-item-summary">
        <span class="admin-webinar-item-num">{{ $webinarNumber ?? '·' }}</span>

        @if (! empty($thumbPath))
            <img src="{{ page_image($thumbPath) }}" alt="" class="admin-webinar-item-thumb">
        @else
            <span class="admin-webinar-item-thumb admin-webinar-item-thumb--empty" aria-hidden="true"></span>
        @endif

        <div class="admin-webinar-item-text">
            <strong class="admin-webinar-item-title admin-webinar-card-label">{{ $displayTitle }}</strong>
            <span class="admin-webinar-item-sub admin-webinar-slug-preview">
                @if ($slugPreview !== '')
                    {{ $slugPreview }}
                @else
                    No URL slug yet
                @endif
                · {{ $hasVideo ? 'Video linked' : 'No video URL' }}
            </span>
        </div>

        <div class="admin-webinar-item-actions">
            <button type="button" class="admin-btn admin-btn-secondary admin-btn-sm admin-webinar-edit-btn">Edit</button>
            <button type="button" class="admin-btn admin-btn-danger admin-btn-sm admin-repeater-remove">Delete</button>
        </div>
    </div>

    <div class="admin-webinar-item-panel">
        <p class="admin-webinar-panel-heading">Edit webinar details</p>

        <div class="admin-form-row-inline">
            <div class="admin-form-group">
                <label for="webinar_{{ $index }}_title">Title <span class="admin-required">*</span></label>
                <input type="text" id="webinar_{{ $index }}_title" name="{{ $prefix }}[title]" value="{{ old("content.items.{$index}.title", $row['title'] ?? '') }}" class="admin-form-control admin-webinar-title-input">
            </div>
            <div class="admin-form-group">
                <label for="webinar_{{ $index }}_slug">URL slug</label>
                <input type="text" id="webinar_{{ $index }}_slug" name="{{ $prefix }}[slug]" value="{{ old("content.items.{$index}.slug", $row['slug'] ?? '') }}" class="admin-form-control admin-webinar-slug-input" placeholder="successful-strategies-to-manage-hcm2">
                <small class="admin-help">Optional. Used for /webinar--slug redirects.</small>
            </div>
        </div>

        <div class="admin-form-group">
            <label for="webinar_{{ $index }}_summary">Short summary (listing page)</label>
            <textarea id="webinar_{{ $index }}_summary" name="{{ $prefix }}[summary]" rows="3" class="admin-form-control admin-textarea">{{ old("content.items.{$index}.summary", $row['summary'] ?? '') }}</textarea>
        </div>

        <div class="admin-form-row-inline admin-form-row-inline--top">
            <div class="admin-form-group">
                <label>Thumbnail image</label>
                @include('admin.pages.partials.image-field', [
                    'inputName' => "{$prefix}[image]",
                    'value' => $row['image'] ?? null,
                ])
            </div>
            <div class="admin-form-group">
                <label for="webinar_{{ $index }}_video">YouTube / video URL</label>
                <input type="url" id="webinar_{{ $index }}_video" name="{{ $prefix }}[video_url]" value="{{ old("content.items.{$index}.video_url", $row['video_url'] ?? '') }}" class="admin-form-control admin-webinar-video-input" placeholder="https://youtu.be/...">
                <small class="admin-help">Visitors go here after they submit the “Register to Watch” form.</small>
            </div>
        </div>

        <button type="button" class="admin-btn admin-btn-secondary admin-btn-sm admin-webinar-done-btn">Done editing</button>
    </div>
</div>
