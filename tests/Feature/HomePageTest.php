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

it('renders hero home block with promo cards in text mode for {locale}', function (string $locale) {
    // Create home page with hero block containing promo cards in text mode
    $page = Page::first();
    $page->setTranslation('blocks', $locale, [
        [
            'type' => 'hero-home',
            'data' => [
                'title' => 'Your Interior',
                'title_highlight' => 'Manage',
                'subtitle' => 'Transform your space',
                'cta_text' => 'Get Started',
                'cta_url' => '/contact',
                'promo_1_mode' => 'text',
                'promo_1_badge' => '30% OFF',
                'promo_1_title' => 'Visit our showroom',
                'promo_1_subtitle' => 'to get your 30% Discount',
                'promo_2_mode' => 'text',
                'promo_2_badge' => '20% OFF',
                'promo_2_title' => 'Special offer',
                'promo_2_subtitle' => 'for limited time',
            ],
        ],
    ]);
    $page->save();

    $response = $this->get("/{$locale}");

    $response->assertOk();
    $response->assertSee('30% OFF', false);
    $response->assertSee('Visit our showroom', false);
    $response->assertSee('to get your 30% Discount', false);
    $response->assertSee('20% OFF', false);
    $response->assertSee('Special offer', false);
    $response->assertSee('for limited time', false);
    $response->assertDontSee('Download PDF', false);
})->with('locales');

it('renders hero home block with promo cards in PDF mode for {locale}', function (string $locale) {
    // Create home page with hero block containing promo cards in PDF mode
    $page = Page::first();
    $page->setTranslation('blocks', $locale, [
        [
            'type' => 'hero-home',
            'data' => [
                'title' => 'Your Interior',
                'title_highlight' => 'Manage',
                'subtitle' => 'Transform your space',
                'cta_text' => 'Get Started',
                'cta_url' => '/contact',
                'promo_1_mode' => 'pdf',
                'promo_1_badge' => '30% OFF',
                'promo_1_pdf' => 'hero-pdfs/promo-catalog-1.pdf',
                'promo_2_mode' => 'pdf',
                'promo_2_badge' => '20% OFF',
                'promo_2_pdf' => 'hero-pdfs/promo-catalog-2.pdf',
            ],
        ],
    ]);
    $page->save();

    $response = $this->get("/{$locale}");

    $response->assertOk();
    $response->assertSee('30% OFF', false);
    $response->assertSee('20% OFF', false);
    $response->assertSee('Download PDF', false);
    $response->assertSee('storage/hero-pdfs/promo-catalog-1.pdf', false);
    $response->assertSee('storage/hero-pdfs/promo-catalog-2.pdf', false);
    $response->assertSee('pesaro-promo-card-link', false);
    $response->assertSee('download', false);
})->with('locales');

it('renders hero home block with mixed promo card modes for {locale}', function (string $locale) {
    // Create home page with one text mode and one PDF mode promo card
    $page = Page::first();
    $page->setTranslation('blocks', $locale, [
        [
            'type' => 'hero-home',
            'data' => [
                'title' => 'Your Interior',
                'title_highlight' => 'Manage',
                'subtitle' => 'Transform your space',
                'cta_text' => 'Get Started',
                'cta_url' => '/contact',
                'promo_1_mode' => 'text',
                'promo_1_badge' => '30% OFF',
                'promo_1_title' => 'Visit our showroom',
                'promo_1_subtitle' => 'to get your 30% Discount',
                'promo_2_mode' => 'pdf',
                'promo_2_badge' => '20% OFF',
                'promo_2_pdf' => 'hero-pdfs/promo-catalog.pdf',
            ],
        ],
    ]);
    $page->save();

    $response = $this->get("/{$locale}");

    $response->assertOk();
    // Check text mode promo card
    $response->assertSee('Visit our showroom', false);
    $response->assertSee('to get your 30% Discount', false);
    // Check PDF mode promo card
    $response->assertSee('storage/hero-pdfs/promo-catalog.pdf', false);
    $response->assertSee('Download PDF', false);
})->with('locales');
