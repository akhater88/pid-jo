<?php

declare(strict_types=1);

use App\Models\Page;

beforeEach(function () {
    // Create home page
    Page::create([
        'title' => ['en' => 'Home', 'ar' => 'الرئيسية'],
        'slug' => ['en' => 'home', 'ar' => 'الرئيسية'],
        'blocks' => [
            'en' => [],
            'ar' => [],
        ],
        'published_at' => now(),
        'sort_order' => 0,
    ]);
});

it('renders home page in {locale}', function (string $locale) {
    $response = $this->get("/{$locale}");

    $response->assertOk();
    $response->assertSee('dir="' . ($locale === 'ar' ? 'rtl' : 'ltr') . '"', false);
})->with('locales');

it('includes header and footer in {locale}', function (string $locale) {
    $response = $this->get("/{$locale}");

    $response->assertOk();
    // Check for header elements (shows different text per locale)
    $headerText = $locale === 'ar' ? 'بيسارو' : 'PESARO';
    $response->assertSee($headerText, false);
    // Check for footer elements
    $response->assertSee('Copy Right', false);
})->with('locales');

it('has correct meta tags for {locale}', function (string $locale) {
    $response = $this->get("/{$locale}");

    $response->assertOk();
    $response->assertSee('<html lang="' . $locale . '"', false);
    $response->assertSee('viewport', false);
    $response->assertSee('csrf-token', false);
})->with('locales');
