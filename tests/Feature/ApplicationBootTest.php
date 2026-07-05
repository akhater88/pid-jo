<?php

declare(strict_types=1);


test('application boots successfully', function () {
    expect(true)->toBeTrue();
});

test('has filament panel registered', function () {
    $panels = \Filament\Facades\Filament::getPanels();

    expect($panels)->toHaveKey('admin');
});

test('environment is configured correctly', function () {
    expect(config('app.name'))->toBe('Pesaro');
    expect(config('app.env'))->toBe('testing');
});

test('database connection works', function () {
    expect(\DB::connection()->getPdo())->not->toBeNull();
});
