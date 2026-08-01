<?php

declare(strict_types=1);


it('renders contact page in {locale}', function (string $locale) {
    $response = $this->get("/{$locale}/contact");

    $response->assertOk();
    $response->assertSee('name');
    $response->assertSee('email');
    $response->assertSee('message');
})->with('locales');

it('validates required fields on contact form', function () {
    $response = $this->post('/en/contact', []);

    $response->assertSessionHasErrors(['name', 'email', 'subject', 'message']);
});

it('validates email format', function () {
    $response = $this->post('/en/contact', [
        'name' => 'John Doe',
        'email' => 'invalid-email',
        'subject' => 'Test',
        'message' => 'Test message',
    ]);

    $response->assertSessionHasErrors(['email']);
});

it('successfully submits contact form', function () {
    $response = $this->post('/en/contact', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'phone' => '+962 79 123 4567',
        'subject' => 'Inquiry',
        'message' => 'I would like to know more about your services.',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    // Check form submission was created
    $this->assertDatabaseHas('form_submissions', [
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'subject' => 'Inquiry',
        'type' => 'contact',
    ]);
});

it('silently rejects honeypot spam', function () {
    $response = $this->post('/en/contact', [
        'name' => 'Spam Bot',
        'email' => 'spam@example.com',
        'subject' => 'Spam',
        'message' => 'This is spam',
        'pesaro_field' => 'filled by bot', // Honeypot field
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    // Check NO submission was created
    $this->assertDatabaseMissing('form_submissions', [
        'email' => 'spam@example.com',
    ]);
});
