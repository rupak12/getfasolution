@php
    $type = $field['type'] ?? 'text';
    $label = $field['label'] ?? ucwords(str_replace('_', ' ', $fieldName));
    $inputName = "{$prefix}[{$fieldName}]";
@endphp

@if ($type === 'repeater')
    <div class="admin-form-group admin-repeater" data-repeater="{{ $inputName }}">
        <div class="admin-repeater-header">
            <label>{{ $label }}</label>
            <button type="button" class="admin-btn admin-btn-secondary admin-btn-sm admin-repeater-add" data-target="{{ $inputName }}">
                + Add Item
            </button>
        </div>

        <div class="admin-repeater-items" data-repeater-items="{{ $inputName }}">
            @php $rows = is_array($value) ? $value : []; @endphp
            @forelse ($rows as $index => $row)
                <div class="admin-repeater-item" data-index="{{ $index }}">
                    <div class="admin-repeater-item-header">
                        <strong>Item {{ $index + 1 }}</strong>
                        <button type="button" class="admin-btn admin-btn-danger admin-btn-sm admin-repeater-remove">Remove</button>
                    </div>
                    @foreach ($field['fields'] ?? [] as $subName => $subField)
                        @include('admin.pages.partials.field', [
                            'fieldName' => $subName,
                            'field' => $subField,
                            'value' => $row[$subName] ?? null,
                            'prefix' => "{$inputName}[{$index}]",
                            'routes' => $routes,
                        ])
                    @endforeach
                </div>
            @empty
                <div class="admin-repeater-item" data-index="0">
                    <div class="admin-repeater-item-header">
                        <strong>Item 1</strong>
                        <button type="button" class="admin-btn admin-btn-danger admin-btn-sm admin-repeater-remove">Remove</button>
                    </div>
                    @foreach ($field['fields'] ?? [] as $subName => $subField)
                        @include('admin.pages.partials.field', [
                            'fieldName' => $subName,
                            'field' => $subField,
                            'value' => null,
                            'prefix' => "{$inputName}[0]",
                            'routes' => $routes,
                        ])
                    @endforeach
                </div>
            @endforelse
        </div>

        <template class="admin-repeater-template" data-template="{{ $inputName }}">
            <div class="admin-repeater-item" data-index="__INDEX__">
                <div class="admin-repeater-item-header">
                    <strong>Item __NUMBER__</strong>
                    <button type="button" class="admin-btn admin-btn-danger admin-btn-sm admin-repeater-remove">Remove</button>
                </div>
                @foreach ($field['fields'] ?? [] as $subName => $subField)
                    @php
                        $subType = $subField['type'] ?? 'text';
                        $subLabel = $subField['label'] ?? ucwords(str_replace('_', ' ', $subName));
                        $subInput = "{$inputName}[__INDEX__][{$subName}]";
                    @endphp
                    <div class="admin-form-group">
                        <label>{{ $subLabel }}</label>
                        @if ($subType === 'html' || $subType === 'textarea')
                            <textarea name="{{ $subInput }}" rows="4" class="admin-form-control admin-textarea"></textarea>
                        @elseif ($subType === 'image')
                            @include('admin.pages.partials.image-field', ['inputName' => $subInput, 'value' => null])
                        @elseif ($subType === 'url')
                            <input type="url" name="{{ $subInput }}" class="admin-form-control">
                        @else
                            <input type="text" name="{{ $subInput }}" class="admin-form-control">
                        @endif
                    </div>
                @endforeach
            </div>
        </template>
    </div>
@else
    <div class="admin-form-group">
        <label for="{{ str_replace(['[', ']'], ['_', ''], $inputName) }}">{{ $label }}</label>

        @if ($type === 'html' || $type === 'textarea')
            @php
                $fieldOldKey = str_replace(['[', ']'], ['.', ''], $inputName);
                $fieldValue = old($fieldOldKey, is_array($value) ? '' : html_to_plain($value ?? ''));
            @endphp
            <textarea id="{{ str_replace(['[', ']'], ['_', ''], $inputName) }}" name="{{ $inputName }}" rows="4" class="admin-form-control admin-textarea" placeholder="Type plain text only — no HTML tags needed">{{ $fieldValue }}</textarea>
        @elseif ($type === 'image')
            @include('admin.pages.partials.image-field', [
                'inputName' => $inputName,
                'value' => is_array($value) ? null : $value,
            ])
        @elseif ($type === 'route')
            <select id="{{ str_replace(['[', ']'], ['_', ''], $inputName) }}" name="{{ $inputName }}" class="admin-form-control">
                <option value="">— Select page —</option>
                @foreach ($routes as $routeName => $routeLabel)
                    <option value="{{ $routeName }}" @selected(old(str_replace(['[', ']'], ['.', ''], $inputName), $value) === $routeName)>
                        {{ $routeLabel }}
                    </option>
                @endforeach
            </select>
        @elseif ($type === 'url')
            <input type="url" id="{{ str_replace(['[', ']'], ['_', ''], $inputName) }}" name="{{ $inputName }}" value="{{ old(str_replace(['[', ']'], ['.', ''], $inputName), is_array($value) ? '' : ($value ?? '')) }}" class="admin-form-control">
        @else
            <input type="text" id="{{ str_replace(['[', ']'], ['_', ''], $inputName) }}" name="{{ $inputName }}" value="{{ old(str_replace(['[', ']'], ['.', ''], $inputName), is_array($value) ? '' : ($value ?? '')) }}" class="admin-form-control">
        @endif
    </div>
@endif
