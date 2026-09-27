<?php

namespace App\Services;

class PageContentNormalizer
{
    public function forAdmin(array $content, array $fields): array
    {
        $content = $this->migrateLegacyContentField($content, $fields);

        return $this->plainTextFields($content, $fields);
    }

    public function forStorage(array $content, array $fields): array
    {
        $content = $this->migrateLegacyContentField($content, $fields);
        $content = $this->plainTextFields($content, $fields, sanitize: true);

        if (isset($fields['paragraph_1'], $content['content'])) {
            unset($content['content']);
        }

        return $content;
    }

    private function migrateLegacyContentField(array $content, array $fields): array
    {
        if (! isset($content['content']) || ! is_string($content['content'])) {
            return $content;
        }

        if (! isset($fields['paragraph_1'])) {
            return $content;
        }

        if (! empty($content['paragraph_1']) || ! empty($content['paragraph_2'])) {
            return $content;
        }

        $paragraphs = page_html_to_paragraphs($content['content']);

        foreach (['paragraph_1', 'paragraph_2', 'paragraph_3', 'paragraph_4'] as $index => $key) {
            if (isset($fields[$key]) && isset($paragraphs[$index])) {
                $content[$key] = $paragraphs[$index];
            }
        }

        return $content;
    }

    private function plainTextFields(array $content, array $fields, string $prefix = '', bool $sanitize = false): array
    {
        foreach ($fields as $name => $field) {
            $type = $field['type'] ?? 'text';

            if ($type === 'repeater') {
                foreach ($content[$name] ?? [] as $index => $row) {
                    if (is_array($row)) {
                        $content[$name][$index] = $this->plainTextFields(
                            $row,
                            $field['fields'] ?? [],
                            "{$prefix}{$name}.{$index}.",
                            $sanitize
                        );
                    }
                }

                continue;
            }

            if ($type === 'textarea' && isset($content[$name]) && is_string($content[$name])) {
                if ($name === 'bullets') {
                    $content[$name] = implode("\n", page_bullet_lines($content[$name]));
                } else {
                    $content[$name] = $sanitize
                        ? plain_text_sanitize($content[$name])
                        : html_to_plain($content[$name]);
                }
            }
        }

        return $content;
    }
}
