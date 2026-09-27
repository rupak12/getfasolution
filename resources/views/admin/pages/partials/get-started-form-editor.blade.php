@php
    $content = normalize_get_started_started($content ?? []);
    $schema = $schema ?? [];
    $fields = $schema['fields'] ?? [];
@endphp

<div class="admin-section-cards">
    <section class="admin-section-card">
        <header class="admin-section-card-head">
            <h3>Intro text</h3>
            <p>Main heading and paragraph above the newsletter and buttons.</p>
        </header>
        @include('admin.pages.partials.field', [
            'fieldName' => 'title',
            'field' => $fields['title'] ?? ['type' => 'text', 'label' => 'Main Heading'],
            'value' => $content['title'] ?? null,
            'prefix' => 'content',
            'routes' => $routes,
        ])
        @include('admin.pages.partials.field', [
            'fieldName' => 'paragraph_1',
            'field' => $fields['paragraph_1'] ?? ['type' => 'textarea', 'label' => 'Intro Paragraph'],
            'value' => $content['paragraph_1'] ?? null,
            'prefix' => 'content',
            'routes' => $routes,
        ])
    </section>

    <section class="admin-section-card">
        <header class="admin-section-card-head">
            <h3>Newsletter box</h3>
            <p>Label above the name and email fields (the form itself is fixed on the site).</p>
        </header>
        @include('admin.pages.partials.field', [
            'fieldName' => 'newsletter_label',
            'field' => $fields['newsletter_label'] ?? ['type' => 'text', 'label' => 'Newsletter Label'],
            'value' => $content['newsletter_label'] ?? null,
            'prefix' => 'content',
            'routes' => $routes,
        ])
    </section>

    <section class="admin-section-card">
        <header class="admin-section-card-head">
            <h3>Action buttons (right column)</h3>
            <p>Two green buttons with icons. Pick an internal page or paste a full custom URL (custom URL wins if both are set).</p>
        </header>
        <div class="admin-section-card-grid">
            <div class="admin-section-card-panel">
                <h4>Button 1</h4>
                @foreach (['button_1_text', 'button_1_route', 'button_1_url'] as $fieldName)
                    @include('admin.pages.partials.field', [
                        'fieldName' => $fieldName,
                        'field' => $fields[$fieldName] ?? ['type' => 'text', 'label' => $fieldName],
                        'value' => $content[$fieldName] ?? null,
                        'prefix' => 'content',
                        'routes' => $routes,
                    ])
                @endforeach
            </div>
            <div class="admin-section-card-panel">
                <h4>Button 2</h4>
                @foreach (['button_2_text', 'button_2_route', 'button_2_url'] as $fieldName)
                    @include('admin.pages.partials.field', [
                        'fieldName' => $fieldName,
                        'field' => $fields[$fieldName] ?? ['type' => 'text', 'label' => $fieldName],
                        'value' => $content[$fieldName] ?? null,
                        'prefix' => 'content',
                        'routes' => $routes,
                    ])
                @endforeach
            </div>
        </div>
    </section>

    <section class="admin-section-card">
        <header class="admin-section-card-head">
            <h3>Contact form (right column)</h3>
            <p>Heading and disclaimer text under the contact form fields.</p>
        </header>
        @include('admin.pages.partials.field', [
            'fieldName' => 'contact_form_title',
            'field' => $fields['contact_form_title'] ?? ['type' => 'text', 'label' => 'Contact Form Heading'],
            'value' => $content['contact_form_title'] ?? null,
            'prefix' => 'content',
            'routes' => $routes,
        ])
        @include('admin.pages.partials.field', [
            'fieldName' => 'recaptcha_notice',
            'field' => $fields['recaptcha_notice'] ?? ['type' => 'textarea', 'label' => 'Contact Form Disclaimer'],
            'value' => $content['recaptcha_notice'] ?? null,
            'prefix' => 'content',
            'routes' => $routes,
        ])
    </section>
</div>
