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

it('displays gallery viewer when service has gallery images', function () {
    $service = Service::first();

    // Add gallery images
    $service->addMedia(storage_path('app/public/test-image.jpg'))
        ->preservingOriginal()
        ->toMediaCollection('gallery');

    $response = $this->get('/en/services/kitchen-design');

    $response->assertOk();
    $response->assertSee('Project Gallery', false);
    $response->assertSee('x-data="serviceGalleryViewer()"', false);
});

it('includes gallery viewer JavaScript function', function () {
    $service = Service::first();

    // Add gallery image
    $service->addMedia(storage_path('app/public/test-image.jpg'))
        ->preservingOriginal()
        ->toMediaCollection('gallery');

    $response = $this->get('/en/services/kitchen-design');

    $response->assertOk();
    $response->assertSee('function serviceGalleryViewer()', false);
    $response->assertSee('openGallery(index)', false);
    $response->assertSee('close()', false);
    $response->assertSee('next()', false);
    $response->assertSee('prev()', false);
});

it('displays gallery thumbnails with click handlers', function () {
    $service = Service::first();

    // Add gallery images
    $service->addMedia(storage_path('app/public/test-image.jpg'))
        ->preservingOriginal()
        ->toMediaCollection('gallery');

    $response = $this->get('/en/services/kitchen-design');

    $response->assertOk();
    $response->assertSee('@click="openGallery(0)"', false);
    $response->assertSee('cursor-pointer', false);
});

it('includes lightbox modal with navigation controls', function () {
    $service = Service::first();

    // Add gallery images
    $service->addMedia(storage_path('app/public/test-image.jpg'))
        ->preservingOriginal()
        ->toMediaCollection('gallery');

    $response = $this->get('/en/services/kitchen-design');

    $response->assertOk();
    // Check for modal
    $response->assertSee('x-show="isOpen"', false);
    $response->assertSee('fixed inset-0 z-50', false);

    // Check for navigation
    $response->assertSee('@click="prev()"', false);
    $response->assertSee('@click="next()"', false);
    $response->assertSee('@click="close()"', false);

    // Check for image counter
    $response->assertSee('currentIndex + 1', false);
    $response->assertSee('images.length', false);
});

it('includes keyboard navigation support', function () {
    $service = Service::first();

    // Add gallery images
    $service->addMedia(storage_path('app/public/test-image.jpg'))
        ->preservingOriginal()
        ->toMediaCollection('gallery');

    $response = $this->get('/en/services/kitchen-design');

    $response->assertOk();
    $response->assertSee('@keydown.escape.window="close()"', false);
    $response->assertSee('@keydown.arrow-left.window="prev()"', false);
    $response->assertSee('@keydown.arrow-right.window="next()"', false);
});

it('includes RTL support in navigation buttons', function () {
    $service = Service::first();

    // Add gallery images
    $service->addMedia(storage_path('app/public/test-image.jpg'))
        ->preservingOriginal()
        ->toMediaCollection('gallery');

    $response = $this->get('/en/services/kitchen-design');

    $response->assertOk();
    $response->assertSee('rtl:rotate-180', false);
});

it('does not display gallery section when service has no gallery images', function () {
    $response = $this->get('/en/services/kitchen-design');

    $response->assertOk();
    $response->assertDontSee('Project Gallery', false);
    $response->assertDontSee('serviceGalleryViewer', false);
});
