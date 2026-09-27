@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
    <div class="admin-dashboard">
        <section class="admin-security-section">
            <header class="admin-security-section-head">
                <h2>Security & server</h2>
                <p>Live checks for protection, environment, and server load.</p>
            </header>

            <div class="admin-dashboard-health">
                <div class="admin-health-card admin-health-card--cpu admin-health-card--{{ $cpu['level'] }}">
                    <div class="admin-health-card-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <rect x="4" y="4" width="16" height="16" rx="2"/>
                            <path d="M9 9h6v6H9z"/>
                            <path d="M9 1v3M15 1v3M9 20v3M15 20v3M1 9h3M1 15h3M20 9h3M20 15h3"/>
                        </svg>
                    </div>
                    <div class="admin-health-card-body">
                        <span class="admin-health-card-label">Server CPU usage</span>
                        <strong class="admin-health-card-value">{{ $cpu['display'] }}</strong>
                        <p class="admin-health-card-hint">{{ $cpu['hint'] }}</p>
                        @if ($cpu['available'] && $cpu['percent'] !== null)
                            <div class="admin-health-meter" role="progressbar" aria-valuenow="{{ $cpu['percent'] }}" aria-valuemin="0" aria-valuemax="100">
                                <span style="width: {{ $cpu['percent'] }}%;"></span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="admin-health-card admin-health-card--cloudflare {{ $cloudflare['active'] ? 'is-active' : 'is-inactive' }}">
                    <div class="admin-health-card-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M16.5 8.5c-.3-2.1-2.1-3.8-4.4-3.8-1.5 0-2.8.8-3.5 2-1.4-.2-2.7.7-3.1 2-.1.4-.1.8-.1 1.2 0 .2 0 .4.1.6h11.9c.7 0 1.3-.6 1.3-1.3 0-.3-.1-.5-.2-.7z"/>
                        </svg>
                    </div>
                    <div class="admin-health-card-body">
                        <span class="admin-health-card-label">Edge protection</span>
                        <strong class="admin-health-card-value">{{ $cloudflare['title'] }}</strong>
                        <p class="admin-health-card-hint">{{ $cloudflare['message'] }}</p>
                        @if ($cloudflare['active'])
                            <span class="admin-health-badge admin-health-badge--success">Active</span>
                        @else
                            <span class="admin-health-badge admin-health-badge--muted">Not detected</span>
                        @endif
                        @if ($cloudflare['ray_id'])
                            <p class="admin-health-ray">Ray ID: <code>{{ $cloudflare['ray_id'] }}</code></p>
                        @endif
                    </div>
                </div>
            </div>

            <div class="admin-security-grid">
                @foreach ($securityFeatures as $feature)
                    <article class="admin-security-item admin-security-item--{{ $feature['status'] }}">
                        <span class="admin-security-item-status" aria-hidden="true"></span>
                        <div>
                            <h3>{{ $feature['title'] }}</h3>
                            <p>{{ $feature['message'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>
    </div>
@endsection
