<?php

declare(strict_types=1);


it('renders terms page in {locale}', function (string $locale) {
    $response = $this->get("/{$locale}/terms-conditions");

    $response->assertOk();
    $response->assertSee('Terms', false);
})->with('locales');

it('renders privacy page in {locale}', function (string $locale) {
    $response = $this->get("/{$locale}/privacy-policy");

    $response->assertOk();
    $response->assertSee(__('Privacy Policy'), false);
})->with('locales');

it('displays terms content from settings in English', function () {
    $response = $this->get('/en/terms-conditions');

    $response->assertOk();
    // Check that HTML content is rendered
    $response->assertSee('Introduction', false);
    $response->assertSee('Intellectual Property Rights', false);
});

it('displays terms content from settings in Arabic', function () {
    $response = $this->get('/ar/terms-conditions');

    $response->assertOk();
    // Check that HTML content is rendered
    $response->assertSee('المقدمة', false);
    $response->assertSee('حقوق الملكية الفكرية', false);
});

it('displays privacy content from settings in English', function () {
    $response = $this->get('/en/privacy-policy');

    $response->assertOk();
    // Check that HTML content is rendered
    $response->assertSee('Introduction', false);
    $response->assertSee('Information We Collect', false);
});

it('displays privacy content from settings in Arabic', function () {
    $response = $this->get('/ar/privacy-policy');

    $response->assertOk();
    // Check that HTML content is rendered
    $response->assertSee('المقدمة', false);
    $response->assertSee('المعلومات التي نجمعها', false);
});

it('includes breadcrumb navigation in terms page for {locale}', function (string $locale) {
    $response = $this->get("/{$locale}/terms-conditions");

    $response->assertOk();
    $response->assertSee(__('Home'), false);
})->with('locales');

it('includes breadcrumb navigation in privacy page for {locale}', function (string $locale) {
    $response = $this->get("/{$locale}/privacy-policy");

    $response->assertOk();
    $response->assertSee(__('Home'), false);
})->with('locales');

it('displays last updated date on terms page', function () {
    $response = $this->get('/en/terms-conditions');

    $response->assertOk();
    $response->assertSee('Last updated:', false);
});

it('displays last updated date on privacy page', function () {
    $response = $this->get('/en/privacy-policy');

    $response->assertOk();
    $response->assertSee('Last updated:', false);
});

it('footer links point to terms page in {locale}', function (string $locale) {
    $response = $this->get("/{$locale}");

    $response->assertOk();
    $response->assertSee("/{$locale}/terms-conditions", false);
})->with('locales');

it('footer links point to privacy page in {locale}', function (string $locale) {
    $response = $this->get("/{$locale}");

    $response->assertOk();
    $response->assertSee("/{$locale}/privacy-policy", false);
})->with('locales');

it('uses hero design matching About Us page', function () {
    $response = $this->get('/en/terms-conditions');

    $response->assertOk();
    // Check for hero classes
    $response->assertSee('pesaro-about-hero', false);
    $response->assertSee('pesaro-about-hero-overlay', false);
});
