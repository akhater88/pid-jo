<?php

declare(strict_types=1);

test('root redirects to en by default', function () {
    $response = $this->get('/');

    $response->assertRedirect('/en');
});

test('root redirects based on Accept-Language header', function (string $header, string $expectedLocale) {
    $response = $this->withHeaders(['Accept-Language' => $header])->get('/');

    $response->assertRedirect('/' . $expectedLocale);
})->with([
    ['en', 'en'],
    ['en-US', 'en'],
    ['ar', 'ar'],
    ['ar-JO', 'ar'],
    ['fr,en;q=0.9', 'en'],
    ['fr', 'en'], // fallback to default
]);

test('root respects pesaro_locale cookie', function (string $cookieLocale) {
    $response = $this->withCookie('pesaro_locale', $cookieLocale)->get('/');

    $response->assertRedirect('/' . $cookieLocale);
})->with(['en', 'ar']);

test('locale homepage renders correctly', function (string $locale) {
    $response = $this->get('/' . $locale);

    $response->assertOk();
    $response->assertSee('dir="' . ($locale === 'ar' ? 'rtl' : 'ltr') . '"', false);
    $response->assertSee('lang="' . $locale . '"', false);
})->with('locales');

test('language switcher sets cookie and redirects', function (string $targetLocale) {
    $response = $this->get('/locale/' . $targetLocale);

    $response->assertRedirect('/' . $targetLocale);
    $response->assertCookie('pesaro_locale', $targetLocale);
})->with('locales');

test('language switcher returns 404 for invalid locale', function () {
    $response = $this->get('/locale/invalid');

    $response->assertNotFound();
});

test('language switcher rewrites referer URL', function () {
    $response = $this->withHeaders([
        'referer' => 'http://localhost/en/about',
    ])->get('/locale/ar');

    $response->assertRedirect('/ar/about');
});

test('placeholder page displays correct translations', function (string $locale) {
    $response = $this->get('/' . $locale);

    $response->assertOk();

    if ($locale === 'en') {
        $response->assertSee('PESARO');
        $response->assertSee('Crafted interiors, coming soon.');
    } else {
        $response->assertSee('بيسارو');
        $response->assertSee('تصاميم داخلية مصنوعة بإتقان، قريباً.');
    }
})->with('locales');
