<?php

declare(strict_types=1);

use App\Models\Faq;

use function Pest\Laravel\get;

it('renders faq page in {locale}', function (string $locale) {
    $response = get("/{$locale}/faq");

    $response->assertOk();
    $response->assertSee(__('Frequently Asked Questions'), false);
    $response->assertSee(__('FAQ Questions'), false);
})->with('locales');

it('displays published FAQs in {locale}', function (string $locale) {
    Faq::create([
        'question' => [
            'en' => 'What services do you offer?',
            'ar' => 'ما هي الخدمات التي تقدمونها؟',
        ],
        'answer' => [
            'en' => 'We offer interior design, kitchens, and decoration services.',
            'ar' => 'نقدم خدمات التصميم الداخلي والمطابخ والديكور.',
        ],
        'published_at' => now()->subDay(),
        'sort_order' => 1,
    ]);

    $response = get("/{$locale}/faq");

    $response->assertOk();
    if ($locale === 'en') {
        $response->assertSee('What services do you offer?', false);
        $response->assertSee('We offer interior design, kitchens, and decoration services.', false);
    } else {
        $response->assertSee('ما هي الخدمات التي تقدمونها؟', false);
        $response->assertSee('نقدم خدمات التصميم الداخلي والمطابخ والديكور.', false);
    }
})->with('locales');

it('does not display unpublished FAQs', function () {
    Faq::create([
        'question' => [
            'en' => 'Published FAQ',
            'ar' => 'سؤال منشور',
        ],
        'answer' => [
            'en' => 'This is published',
            'ar' => 'هذا منشور',
        ],
        'published_at' => now()->subDay(),
        'sort_order' => 1,
    ]);

    Faq::create([
        'question' => [
            'en' => 'Unpublished FAQ',
            'ar' => 'سؤال غير منشور',
        ],
        'answer' => [
            'en' => 'This is not published',
            'ar' => 'هذا غير منشور',
        ],
        'published_at' => null,
        'sort_order' => 2,
    ]);

    $response = get('/en/faq');

    $response->assertOk();
    $response->assertSee('Published FAQ', false);
    $response->assertDontSee('Unpublished FAQ', false);
});

it('does not display future FAQs', function () {
    Faq::create([
        'question' => [
            'en' => 'Current FAQ',
            'ar' => 'سؤال حالي',
        ],
        'answer' => [
            'en' => 'This is current',
            'ar' => 'هذا حالي',
        ],
        'published_at' => now()->subDay(),
        'sort_order' => 1,
    ]);

    Faq::create([
        'question' => [
            'en' => 'Future FAQ',
            'ar' => 'سؤال مستقبلي',
        ],
        'answer' => [
            'en' => 'This is scheduled for future',
            'ar' => 'هذا مجدول للمستقبل',
        ],
        'published_at' => now()->addDay(),
        'sort_order' => 2,
    ]);

    $response = get('/en/faq');

    $response->assertOk();
    $response->assertSee('Current FAQ', false);
    $response->assertDontSee('Future FAQ', false);
});

it('orders FAQs by sort_order then created_at', function () {
    Faq::create([
        'question' => ['en' => 'Third FAQ', 'ar' => 'السؤال الثالث'],
        'answer' => ['en' => 'Answer 3', 'ar' => 'الجواب 3'],
        'published_at' => now(),
        'sort_order' => 3,
    ]);

    Faq::create([
        'question' => ['en' => 'First FAQ', 'ar' => 'السؤال الأول'],
        'answer' => ['en' => 'Answer 1', 'ar' => 'الجواب 1'],
        'published_at' => now(),
        'sort_order' => 1,
    ]);

    Faq::create([
        'question' => ['en' => 'Second FAQ', 'ar' => 'السؤال الثاني'],
        'answer' => ['en' => 'Answer 2', 'ar' => 'الجواب 2'],
        'published_at' => now(),
        'sort_order' => 2,
    ]);

    $response = get('/en/faq');

    $response->assertOk();
    $content = $response->getContent();

    // Verify order by checking positions
    $pos1 = strpos($content, 'First FAQ');
    $pos2 = strpos($content, 'Second FAQ');
    $pos3 = strpos($content, 'Third FAQ');

    expect($pos1)->toBeLessThan($pos2)
        ->and($pos2)->toBeLessThan($pos3);
});

it('displays empty state when no FAQs exist', function () {
    $response = get('/en/faq');

    $response->assertOk();
    $response->assertSee('No FAQs Yet', false);
    $response->assertSee('Frequently asked questions will be displayed here once they are added.', false);
});

it('includes contact CTA section', function () {
    $response = get('/en/faq');

    $response->assertOk();
    $response->assertSee('Still Have Questions?', false);
    $response->assertSee('Contact Us', false);
});

it('includes breadcrumb navigation in {locale}', function (string $locale) {
    $response = get("/{$locale}/faq");

    $response->assertOk();
    $response->assertSee(__('Home'), false);
    $response->assertSee(__('FAQ Questions'), false);
})->with('locales');

it('footer link points to FAQ page in {locale}', function (string $locale) {
    $response = get("/{$locale}");

    $response->assertOk();
    $response->assertSee("/{$locale}/faq", false);
})->with('locales');
