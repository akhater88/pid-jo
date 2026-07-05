<?php

declare(strict_types=1);

use App\Models\Service;

beforeEach(function () {
    // Create test services
    Service::create([
        'title' => [
            'en' => 'Kitchen Design',
            'ar' => 'تصميم المطابخ',
        ],
        'slug' => [
            'en' => 'kitchen-design',
            'ar' => 'تصميم-المطابخ',
        ],
        'short_description' => [
            'en' => 'Modern kitchen designs',
            'ar' => 'تصاميم مطابخ حديثة',
        ],
        'body' => [
            'en' => '<p>Professional kitchen design services</p>',
            'ar' => '<p>خدمات تصميم المطابخ المهنية</p>',
        ],
        'published_at' => now(),
        'sort_order' => 1,
    ]);
});

it('renders services index page in {locale}', function (string $locale) {
    $response = $this->get("/{$locale}/services");

    $response->assertOk();
    $response->assertSee('Kitchen Design');
})->with('locales');

it('displays published services only', function () {
    // Create unpublished service
    Service::create([
        'title' => ['en' => 'Unpublished', 'ar' => 'غير منشور'],
        'slug' => ['en' => 'unpublished', 'ar' => 'غير-منشور'],
        'short_description' => ['en' => 'Test', 'ar' => 'اختبار'],
        'body' => ['en' => 'Test', 'ar' => 'اختبار'],
        'published_at' => null, // Not published
        'sort_order' => 2,
    ]);

    $response = $this->get('/en/services');

    $response->assertOk();
    $response->assertSee('Kitchen Design');
    $response->assertDontSee('Unpublished');
});

it('renders service detail page in {locale}', function (string $locale) {
    $slug = $locale === 'en' ? 'kitchen-design' : 'تصميم-المطابخ';

    $response = $this->get("/{$locale}/services/{$slug}");

    $response->assertOk();
    $response->assertSee('Kitchen Design');
})->with('locales');

it('returns 404 for non-existent service', function () {
    $response = $this->get('/en/services/non-existent');

    $response->assertNotFound();
});
