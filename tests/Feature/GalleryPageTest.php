<?php

declare(strict_types=1);

use App\Models\GalleryImage;

beforeEach(function () {
    // Create test gallery images
    for ($i = 1; $i <= 5; $i++) {
        GalleryImage::create([
            'title' => [
                'en' => "Gallery Image {$i}",
                'ar' => "صورة المعرض {$i}",
            ],
            'description' => [
                'en' => "Description {$i}",
                'ar' => "وصف {$i}",
            ],
            'show_in_footer' => $i <= 3,
            'published_at' => now(),
            'sort_order' => $i,
        ]);
    }
});

it('renders gallery page in {locale}', function (string $locale) {
    $response = $this->get("/{$locale}/gallery");

    $response->assertOk();
    $response->assertSee('Gallery Image 1');
})->with('locales');

it('displays published gallery images only', function () {
    // Create unpublished image
    GalleryImage::create([
        'title' => ['en' => 'Unpublished', 'ar' => 'غير منشور'],
        'description' => ['en' => 'Test', 'ar' => 'اختبار'],
        'published_at' => null,
        'show_in_footer' => false,
        'sort_order' => 99,
    ]);

    $response = $this->get('/en/gallery');

    $response->assertOk();
    $response->assertDontSee('Unpublished');
});

it('supports pagination on gallery', function () {
    // Create 30 gallery images
    for ($i = 6; $i <= 30; $i++) {
        GalleryImage::create([
            'title' => ['en' => "Image {$i}", 'ar' => "صورة {$i}"],
            'description' => ['en' => 'Desc', 'ar' => 'وصف'],
            'published_at' => now(),
            'show_in_footer' => false,
            'sort_order' => $i,
        ]);
    }

    $response = $this->get('/en/gallery');

    $response->assertOk();
    // Should see pagination links (gallery paginates at 24 items)
    $response->assertSee('page=2');
});
