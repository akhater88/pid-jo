<?php

declare(strict_types=1);

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SiteSettings extends Settings
{
    // Contact Information
    /** @var array<string, string> */
    public array $administration_phone;

    /** @var array<string, string> */
    public array $showroom_phone;

    public string $email;

    /** @var array<string, string> */
    public array $location;

    // Social Media Links
    public ?string $facebook_url;

    public ?string $instagram_url;

    public ?string $linkedin_url;

    public ?string $youtube_url;

    // Footer
    public ?string $footer_background_image;

    public ?string $google_maps_url;

    public static function group(): string
    {
        return 'site';
    }
}
