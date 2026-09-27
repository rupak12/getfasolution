<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HubspotSetting extends Model
{
    protected $fillable = [
        'is_enabled',
        'portal_id',
        'contact_form_guid',
        'newsletter_form_guid',
        'private_app_access_token',
        'connection_verified_at',
    ];

    protected function casts(): array
    {
        return [
            'is_enabled' => 'boolean',
            'private_app_access_token' => 'encrypted',
            'connection_verified_at' => 'datetime',
        ];
    }

    protected $hidden = [
        'private_app_access_token',
    ];

    public static function current(): self
    {
        return static::query()->firstOrCreate([], [
            'is_enabled' => false,
        ]);
    }

    public function hasStoredAccessToken(): bool
    {
        return filled($this->private_app_access_token);
    }

    public function isReadyForContact(): bool
    {
        return $this->is_enabled
            && filled($this->portal_id)
            && filled($this->contact_form_guid)
            && $this->hasStoredAccessToken();
    }

    public function isReadyForNewsletter(): bool
    {
        $formGuid = $this->newsletter_form_guid ?: $this->contact_form_guid;

        return $this->is_enabled
            && filled($this->portal_id)
            && filled($formGuid)
            && $this->hasStoredAccessToken();
    }

    public function newsletterFormGuid(): ?string
    {
        return $this->newsletter_form_guid ?: $this->contact_form_guid;
    }

    public function accessTokenForApi(): ?string
    {
        $token = $this->private_app_access_token;

        return is_string($token) && $token !== '' ? $token : null;
    }

}
