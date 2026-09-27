@extends('admin.layouts.app')

@section('title', 'HubSpot Settings')
@section('page_title', 'HubSpot Settings')

@section('content')
    <div class="admin-card">
        <div class="admin-card-header">
            <div>
                <h2>HubSpot Settings</h2>
                <p class="admin-card-subtitle">
                    Connect site contact and newsletter forms to HubSpot Marketing Forms using a
                    <strong>Private App access token</strong> (server-side only; never exposed to visitors).
                </p>
            </div>
        </div>

        @if ($errors->has('hubspot'))
            <div class="admin-alert admin-alert-danger">{{ $errors->first('hubspot') }}</div>
        @endif

        <form action="{{ route('admin.hubspot.update') }}" method="POST" class="admin-form" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="admin-form-group">
                <label>
                    <input type="checkbox" name="is_enabled" value="1" @checked(old('is_enabled', $settings->is_enabled))>
                    Enable HubSpot form sync
                </label>
                <p class="admin-help-text">When enabled, successful form posts on the site are sent to HubSpot from the server.</p>
            </div>

            <div class="admin-form-group">
                <label for="portal_id">HubSpot Portal ID (Hub ID)</label>
                <input type="text" id="portal_id" name="portal_id" class="admin-form-control"
                    inputmode="numeric" pattern="\d*"
                    value="{{ old('portal_id', $settings->portal_id) }}"
                    placeholder="e.g. 50596748">
                <p class="admin-help-text">Found in your HubSpot URL: <code>app.hubspot.com/forms/<strong>PORTAL_ID</strong></code></p>
            </div>

            <div class="admin-form-group">
                <label for="contact_form_guid">Contact / Get in Touch form GUID</label>
                <input type="text" id="contact_form_guid" name="contact_form_guid" class="admin-form-control"
                    value="{{ old('contact_form_guid', $settings->contact_form_guid) }}"
                    placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx">
                <p class="admin-help-text">Marketing → Forms → open your form → copy the form ID (GUID) from Share or form settings.</p>
            </div>

            <div class="admin-form-group">
                <label for="newsletter_form_guid">Newsletter form GUID (optional)</label>
                <input type="text" id="newsletter_form_guid" name="newsletter_form_guid" class="admin-form-control"
                    value="{{ old('newsletter_form_guid', $settings->newsletter_form_guid) }}"
                    placeholder="Leave empty to use the contact form">
            </div>

            <div class="admin-form-group">
                <label for="private_app_access_token">Private App access token</label>
                <input type="password" id="private_app_access_token" name="private_app_access_token"
                    class="admin-form-control" autocomplete="new-password"
                    placeholder="{{ $hasToken ? '•••••••••••••••• (saved — enter new token to replace)' : 'Paste access token' }}">
                <p class="admin-help-text">
                    Create in HubSpot: Settings → Integrations → <strong>Private Apps</strong> → Create app →
                    scope <strong>forms</strong> (Forms). Copy the access token once; it is stored encrypted in the database.
                </p>
                @if ($hasToken)
                    <p class="admin-help-text admin-help-success">A token is saved. Leave this field blank to keep it.</p>
                @endif
            </div>

            @if ($settings->connection_verified_at)
                <p class="admin-help-text">Last verified: {{ $settings->connection_verified_at->timezone(config('app.timezone'))->format('M j, Y g:i A') }}</p>
            @endif

            <h3 class="admin-form-subheading">HubSpot field mapping</h3>
            <p class="admin-help-text">Ensure your HubSpot form includes these internal field names:</p>
            <ul class="admin-help-list">
                <li>Contact: <code>firstname</code>, <code>lastname</code>, <code>email</code>, <code>phone</code>, <code>jobtitle</code>, <code>company</code>, <code>message</code></li>
                <li>Newsletter: <code>firstname</code>, <code>lastname</code>, <code>email</code></li>
            </ul>

            <div class="admin-form-actions">
                <button type="submit" class="admin-btn admin-btn-primary" name="verify_connection" value="0">Save</button>
                <button type="submit" class="admin-btn admin-btn-secondary" name="verify_connection" value="1">Save &amp; verify connection</button>
            </div>
        </form>
    </div>
@endsection
