<?php

declare(strict_types=1);

use App\Settings\SiteSettings;

it('loads site settings with default contact information', function () {
    $settings = app(SiteSettings::class);

    expect($settings->administration_phone)->toBeArray()
        ->and($settings->administration_phone['en'])->toContain('+962')
        ->and($settings->showroom_phone)->toBeArray()
        ->and($settings->showroom_phone['en'])->toContain('+962')
        ->and($settings->email)->toBeString()
        ->and($settings->email)->toContain('@')
        ->and($settings->location)->toBeArray()
        ->and($settings->location['en'])->toContain('Amman');
});

it('displays contact information in footer for {locale}', function (string $locale) {
    $response = $this->get("/{$locale}");

    $settings = app(SiteSettings::class);

    $response->assertOk();
    $response->assertSee($settings->administration_phone[$locale], false);
    $response->assertSee($settings->showroom_phone[$locale], false);
    $response->assertSee($settings->email, false);
    $response->assertSee($settings->location[$locale], false);
})->with('locales');

it('hides social media icons when URLs are not set', function () {
    $settings = app(SiteSettings::class);

    // Ensure all social links are null
    expect($settings->facebook_url)->toBeNull()
        ->and($settings->instagram_url)->toBeNull()
        ->and($settings->linkedin_url)->toBeNull()
        ->and($settings->youtube_url)->toBeNull();

    $response = $this->get('/en');

    $response->assertOk();
    // The social icons should not have href attributes when URLs are null
    $response->assertDontSee('href="https://facebook.com', false);
    $response->assertDontSee('href="https://instagram.com', false);
    $response->assertDontSee('href="https://linkedin.com', false);
    $response->assertDontSee('href="https://youtube.com', false);
});

it('displays social media icons when URLs are set', function () {
    DB::table('settings')->where('name', 'instagram_url')->update([
        'payload' => json_encode('https://instagram.com/pesaro'),
    ]);

    // Clear settings cache
    app()->forgetInstance(SiteSettings::class);

    $settings = app(SiteSettings::class);
    expect($settings->instagram_url)->toBe('https://instagram.com/pesaro');

    $response = $this->get('/en');

    $response->assertOk();
    $response->assertSee('https://instagram.com/pesaro', false);
    $response->assertSee('aria-label="Instagram"', false);
});

it('displays default footer background when no custom image is uploaded', function () {
    $settings = app(SiteSettings::class);

    expect($settings->footer_background_image)->toBeNull();

    $response = $this->get('/en');

    $response->assertOk();
    $response->assertSee('footer-bg-image.jpg', false);
});

it('displays custom footer background when image is uploaded', function () {
    // Update settings with custom footer background
    $settings = DB::table('settings')->where('group', 'site')->first();
    $payload = json_decode($settings->payload, true);
    $payload['footer_background_image'] = 'footer/custom-bg.jpg';

    DB::table('settings')->where('group', 'site')->update([
        'payload' => json_encode($payload),
    ]);

    // Clear settings cache
    app()->forgetInstance(SiteSettings::class);

    $updatedSettings = app(SiteSettings::class);
    expect($updatedSettings->footer_background_image)->toBe('footer/custom-bg.jpg');

    $response = $this->get('/en');

    $response->assertOk();
    $response->assertSee('storage/footer/custom-bg.jpg', false);
});

it('footer background is clickable when Google Maps URL is set', function () {
    // Update settings with Google Maps URL
    $settings = DB::table('settings')->where('group', 'site')->first();
    $payload = json_decode($settings->payload, true);
    $payload['google_maps_url'] = 'https://maps.google.com/?q=31.9539,35.9106';

    DB::table('settings')->where('group', 'site')->update([
        'payload' => json_encode($payload),
    ]);

    // Clear settings cache
    app()->forgetInstance(SiteSettings::class);

    $updatedSettings = app(SiteSettings::class);
    expect($updatedSettings->google_maps_url)->toBe('https://maps.google.com/?q=31.9539,35.9106');

    $response = $this->get('/en');

    $response->assertOk();
    $response->assertSee('https://maps.google.com/?q=31.9539,35.9106', false);
    $response->assertSee('target="_blank"', false);
    $response->assertSee('View our location on Google Maps', false);
});

it('footer background is not clickable when Google Maps URL is not set', function () {
    $settings = app(SiteSettings::class);

    expect($settings->google_maps_url)->toBeNull();

    $response = $this->get('/en');

    $response->assertOk();
    $response->assertDontSee('href="https://maps.google.com', false);
    $response->assertDontSee('View our location on Google Maps', false);
});
