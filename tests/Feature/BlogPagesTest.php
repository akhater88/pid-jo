<?php

declare(strict_types=1);

use App\Models\BlogPost;

beforeEach(function () {
    // Create test blog post
    BlogPost::create([
        'title' => [
            'en' => '2024 Design Trends',
            'ar' => 'اتجاهات التصميم 2024',
        ],
        'slug' => [
            'en' => '2024-design-trends',
            'ar' => 'اتجاهات-التصميم-2024',
        ],
        'excerpt' => [
            'en' => 'Latest interior design trends',
            'ar' => 'أحدث اتجاهات التصميم الداخلي',
        ],
        'body' => [
            'en' => '<p>Discover the latest trends in interior design</p>',
            'ar' => '<p>اكتشف أحدث الاتجاهات في التصميم الداخلي</p>',
        ],
        'published_at' => now(),
        'sort_order' => 1,
    ]);
});

it('renders blog index page in {locale}', function (string $locale) {
    $response = $this->get("/{$locale}/blog");

    $response->assertOk();
    $response->assertSee('2024 Design Trends');
})->with('locales');

it('displays published blog posts only', function () {
    // Create unpublished post
    BlogPost::create([
        'title' => ['en' => 'Draft Post', 'ar' => 'مسودة منشور'],
        'slug' => ['en' => 'draft-post', 'ar' => 'مسودة-منشور'],
        'excerpt' => ['en' => 'Draft', 'ar' => 'مسودة'],
        'body' => ['en' => 'Draft', 'ar' => 'مسودة'],
        'published_at' => null,
        'sort_order' => 2,
    ]);

    $response = $this->get('/en/blog');

    $response->assertOk();
    $response->assertSee('2024 Design Trends');
    $response->assertDontSee('Draft Post');
});

it('renders blog post detail page in {locale}', function (string $locale) {
    $slug = $locale === 'en' ? '2024-design-trends' : 'اتجاهات-التصميم-2024';

    $response = $this->get("/{$locale}/blog/{$slug}");

    $response->assertOk();
    $response->assertSee('2024 Design Trends');
})->with('locales');

it('returns 404 for non-existent blog post', function () {
    $response = $this->get('/en/blog/non-existent');

    $response->assertNotFound();
});

it('supports pagination on blog index', function () {
    // Create 15 blog posts
    for ($i = 1; $i <= 15; $i++) {
        BlogPost::create([
            'title' => ['en' => "Post {$i}", 'ar' => "منشور {$i}"],
            'slug' => ['en' => "post-{$i}", 'ar' => "منشور-{$i}"],
            'excerpt' => ['en' => 'Excerpt', 'ar' => 'مقتطف'],
            'body' => ['en' => 'Body', 'ar' => 'نص'],
            'published_at' => now(),
            'sort_order' => $i,
        ]);
    }

    $response = $this->get('/en/blog');

    $response->assertOk();
    // Should see pagination links
    $response->assertSee('page=2');
});
