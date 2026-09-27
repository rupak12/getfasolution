<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class GlobalSetting extends Model
{
    public const CACHE_KEY = 'global_settings';

    protected $fillable = [
        'site_name',
        'header_logo',
        'footer_logo',
        'favicon',
        'facebook_url',
        'instagram_url',
        'youtube_url',
        'linkedin_url',
        'contact_phone',
        'contact_email',
        'contact_address',
        'contact_website',
        'footer_about',
        'copyright_text',
        'footer_cta_title',
        'footer_cta_text',
        'footer_newsletter_title',
        'footer_newsletter_text',
        'footer_newsletter_button_text',
    ];

    public static function defaults(): array
    {
        return [
            'site_name' => 'FA Solutions',
            'header_logo' => 'images/logo-new-2.png',
            'footer_logo' => 'images/logo.png',
            'favicon' => 'images/favicon.png',
            'facebook_url' => 'https://www.facebook.com/GetFASolutions',
            'instagram_url' => 'https://www.instagram.com/get_fasolutions',
            'youtube_url' => 'https://www.youtube.com/channel/UC-qnY7C0CVdCbLFUcmGsH4Q',
            'linkedin_url' => 'https://www.linkedin.com/company/getfasolutions/',
            'contact_phone' => '(727) 300-6336',
            'contact_email' => 'FAHelp@getfasolutions.com',
            'contact_address' => '600 1st Ave North, #302 St. Petersburg, FL 33701',
            'contact_website' => 'https://GetFASolutions.com',
            'footer_about' => 'FA Solutions is a financial aid servicing partner that thinks and behaves as an extension of the institution, one that is dependable and responsive to the schools and the students, ultimately enhancing the student aid experience.',
            'copyright_text' => '© {year} All Rights Reserved | FA Solutions | Developed with ❤️ by Truepid Technologies | Privacy Policy',
            'footer_cta_title' => 'Get in Touch With Us Today!',
            'footer_cta_text' => 'Have questions? We\'re here to help. Call us today.',
            'footer_newsletter_title' => 'Sign Up for Our Newsletter',
            'footer_newsletter_text' => 'Stay updated on financial aid trends, compliance changes, and best practices. We never share your data—your privacy is our priority.',
            'footer_newsletter_button_text' => 'Subscribe',
        ];
    }

    public function footerCtaTitle(): string
    {
        return $this->footer_cta_title ?: static::defaults()['footer_cta_title'];
    }

    public function footerCtaText(): string
    {
        return $this->footer_cta_text ?: static::defaults()['footer_cta_text'];
    }

    public function footerNewsletterTitle(): string
    {
        return $this->footer_newsletter_title ?: static::defaults()['footer_newsletter_title'];
    }

    public function footerNewsletterText(): string
    {
        return $this->footer_newsletter_text ?: static::defaults()['footer_newsletter_text'];
    }

    public function footerNewsletterButtonText(): string
    {
        return $this->footer_newsletter_button_text ?: static::defaults()['footer_newsletter_button_text'];
    }

    public static function current(): self
    {
        return Cache::rememberForever(self::CACHE_KEY, function () {
            return static::query()->firstOrCreate([], static::defaults());
        });
    }

    public static function refreshCache(): self
    {
        Cache::forget(self::CACHE_KEY);

        return static::current();
    }

    public function assetUrl(?string $path): string
    {
        $path = $path ?: '';

        if ($path === '') {
            return '';
        }

        if (str_starts_with($path, 'storage/')) {
            return asset($path);
        }

        return media_asset($path);
    }

    public function headerLogoUrl(): string
    {
        return $this->assetUrl($this->header_logo ?: static::defaults()['header_logo']);
    }

    public function footerLogoUrl(): string
    {
        return $this->assetUrl($this->footer_logo ?: static::defaults()['footer_logo']);
    }

    public function faviconUrl(): string
    {
        return $this->assetUrl($this->favicon ?: static::defaults()['favicon']);
    }

    public function phoneHref(): string
    {
        return 'tel:'.preg_replace('/\D+/', '', (string) $this->contact_phone);
    }

    public function websiteHref(): string
    {
        $website = trim((string) $this->contact_website);

        if ($website === '') {
            return '#';
        }

        return str_starts_with($website, 'http') ? $website : 'https://'.$website;
    }

    public function websiteLabel(): string
    {
        $website = trim((string) $this->contact_website);

        return str_replace(['https://', 'http://'], '', $website);
    }

    public function renderedCopyright(): string
    {
        $text = $this->copyright_text ?: static::defaults()['copyright_text'];

        return str_replace('{year}', (string) date('Y'), $text);
    }
}
