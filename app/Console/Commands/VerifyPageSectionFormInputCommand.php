<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\PagesSettingsController;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use ReflectionClass;

class VerifyPageSectionFormInputCommand extends Command
{
    protected $signature = 'pages:verify-form-input';

    protected $description = 'Verify nested admin form fields resolve correctly for every page section';

    public function handle(): int
    {
        $controller = app(PagesSettingsController::class);
        $ref = new ReflectionClass($controller);
        $collect = $ref->getMethod('collectFieldValues');
        $collect->setAccessible(true);

        $failures = 0;
        $checked = 0;

        foreach (config('page_sections.sections', []) as $pageSlug => $sections) {
            foreach ($sections as $sectionKey => $schema) {
                $fields = $schema['fields'] ?? [];

                if ($fields === []) {
                    continue;
                }

                $contentPayload = $this->buildContent($fields);
                $request = Request::create('/fake', 'PUT', ['content' => $contentPayload]);
                $existing = [];

                $content = $collect->invoke($controller, $request, $fields, $existing, $pageSlug, $sectionKey);

                foreach ($this->flattenScalars($contentPayload) as $dotKey => $expected) {
                    $checked++;
                    $actual = data_get($content, $dotKey);

                    if ((string) $actual !== (string) $expected) {
                        $failures++;
                        $this->error("{$pageSlug}/{$sectionKey}: {$dotKey} expected \"{$expected}\", got \"{$actual}\"");
                    }
                }
            }
        }

        if ($failures === 0) {
            $this->info("All {$checked} scalar field checks passed for every page section.");

            return self::SUCCESS;
        }

        $this->warn("{$failures} field(s) failed out of {$checked}.");

        return self::FAILURE;
    }

    private function buildContent(array $fields): array
    {
        $payload = [];

        foreach ($fields as $name => $field) {
            $type = $field['type'] ?? 'text';

            if ($type === 'repeater') {
                $payload[$name] = [$this->buildContent($field['fields'] ?? [])];

                continue;
            }

            if ($type === 'image') {
                continue;
            }

            $payload[$name] = 'test-'.$name;
        }

        return $payload;
    }

    /** @return array<string, scalar> */
    private function flattenScalars(array $data, string $prefix = ''): array
    {
        $flat = [];

        foreach ($data as $key => $value) {
            $path = $prefix === '' ? (string) $key : "{$prefix}.{$key}";

            if (is_array($value)) {
                $flat = array_merge($flat, $this->flattenScalars($value, $path));

                continue;
            }

            if (is_scalar($value)) {
                $flat[$path] = $value;
            }
        }

        return $flat;
    }
}
