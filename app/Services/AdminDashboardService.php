<?php

namespace App\Services;

use Illuminate\Http\Request;

class AdminDashboardService
{
    public function __construct(private Request $request) {}

    /** @return array{available: bool, display: string, percent: ?float, level: string, hint: string} */
    public function cpuUsage(): array
    {
        $percent = $this->readCpuPercent();

        if ($percent === null) {
            return [
                'available' => false,
                'display' => '—',
                'percent' => null,
                'level' => 'unknown',
                'hint' => 'CPU metrics are not available on this host.',
            ];
        }

        $percent = min(100, max(0, round($percent, 1)));

        $level = match (true) {
            $percent >= 85 => 'high',
            $percent >= 60 => 'warn',
            default => 'ok',
        };

        return [
            'available' => true,
            'display' => $percent.'%',
            'percent' => $percent,
            'level' => $level,
            'hint' => 'Approximate server CPU usage right now.',
        ];
    }

    /** @return list<array{title: string, message: string, status: string}> */
    public function securityFeatures(): array
    {
        $cloudflare = $this->cloudflareStatus();

        return [
            [
                'title' => 'HTTPS (SSL)',
                'message' => $this->request->secure()
                    ? 'This session uses an encrypted HTTPS connection.'
                    : 'Enable HTTPS on production so login and forms are encrypted.',
                'status' => $this->request->secure() ? 'ok' : 'warn',
            ],
            [
                'title' => 'Cloudflare protection',
                'message' => $cloudflare['message'],
                'status' => $cloudflare['active'] ? 'ok' : 'warn',
            ],
            [
                'title' => 'Production debug mode',
                'message' => config('app.debug')
                    ? 'APP_DEBUG is on — turn it off on the live server.'
                    : 'Debug mode is disabled (recommended for production).',
                'status' => config('app.debug') ? 'bad' : 'ok',
            ],
            [
                'title' => 'Application environment',
                'message' => 'Running in '.config('app.env').' mode.',
                'status' => app()->environment('production') ? 'ok' : 'warn',
            ],
            [
                'title' => 'Admin authentication',
                'message' => 'Admin pages require a signed-in administrator account.',
                'status' => 'ok',
            ],
            [
                'title' => 'Form protection',
                'message' => 'Public forms use CSRF tokens and request rate limiting.',
                'status' => 'ok',
            ],
            [
                'title' => 'Session security',
                'message' => config('session.encrypt')
                    ? 'Session data encryption is enabled.'
                    : 'Session cookies are HTTP-only with framework defaults.',
                'status' => config('session.encrypt') ? 'ok' : 'warn',
            ],
        ];
    }

    /** @return array{active: bool, ray_id: ?string, title: string, message: string} */
    public function cloudflareStatus(): array
    {
        $ray = $this->request->header('CF-RAY');
        $configured = filter_var(env('CLOUDFLARE_ENABLED', false), FILTER_VALIDATE_BOOLEAN);
        $active = $configured || filled($ray);

        return [
            'active' => $active,
            'ray_id' => is_string($ray) ? $ray : null,
            'title' => $active ? 'Website protected by Cloudflare' : 'Cloudflare not active',
            'message' => $active
                ? 'Your site traffic is routed through Cloudflare for CDN, SSL, and attack protection.'
                : 'On production, enable the Cloudflare proxy or set CLOUDFLARE_ENABLED=true in .env.',
        ];
    }

    private function readCpuPercent(): ?float
    {
        if (PHP_OS_FAMILY === 'Windows') {
            return $this->windowsCpuPercent();
        }

        return $this->linuxCpuPercent();
    }

    private function windowsCpuPercent(): ?float
    {
        if (! function_exists('shell_exec')) {
            return null;
        }

        $output = @shell_exec('wmic cpu get loadpercentage /value 2>nul');

        if (is_string($output) && preg_match('/LoadPercentage=(\d+)/', $output, $matches)) {
            return (float) $matches[1];
        }

        return null;
    }

    private function linuxCpuPercent(): ?float
    {
        if (! function_exists('sys_getloadavg')) {
            return null;
        }

        $load = sys_getloadavg();

        if ($load === false) {
            return null;
        }

        $cores = $this->linuxCpuCoreCount();

        return (($load[0] ?? 0) / max(1, $cores)) * 100;
    }

    private function linuxCpuCoreCount(): int
    {
        $cpuinfo = @file_get_contents('/proc/cpuinfo');

        if ($cpuinfo === false) {
            return 1;
        }

        preg_match_all('/^processor\s/m', $cpuinfo, $matches);

        return max(1, count($matches[0] ?? []));
    }
}
